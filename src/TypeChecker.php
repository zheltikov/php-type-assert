<?php

namespace Zheltikov\TypeAssert;

use InvalidArgumentException;
use RuntimeException;
use Throwable;
use Zheltikov\TypeAssert\Parser\{Lexer, Node, Optimizer, Type, Types};
use Zheltikov\TypeAssert\TypeCheckerState as State;
use Zheltikov\TypeAssert\StateMessage as Message;

use function Zheltikov\Invariant\invariant;
use function Zheltikov\Invariant\invariant_violation;
use function Zheltikov\Memoize\wrap;

/**
 * TODO: add support for messages and expected types/values, to let the user know what is wrong with his data
 * TODO: add support for open tuples: there cannot be a defined type between two ellipsis nodes. For example:
 * tuple(int, ...) // valid
 * tuple(..., int) // valid
 * tuple(int, ..., int) // valid
 * tuple(..., int, ...) // invalid
 *
 * Class TypeChecker
 * @package Zheltikov\Invariant\TypeAssert
 */
final class TypeChecker
{
    private function __construct()
    {
    }

    /**
     * @param string $type
     * @return callable
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    public static function getCheckerFn(string $type): callable
    {
        invariant(strlen(trim($type)), 'Type must not be empty.');
        $ast = self::parseType($type);
        return self::astToCheckerFn($ast);
    }

    /**
     * @param string $type
     * @return \Zheltikov\TypeAssert\Parser\Node
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    protected static function parseType(string $type): Node
    {
        return wrap(
            function (string $type): Node {
                $lexer = new Lexer();
                $parser = new Types($lexer);

                try {
                    $ast = $parser->parse($type);
                } catch (Throwable $error) {
                    throw new RuntimeException(
                        sprintf(
                            'Parse Error%s: %s',
                            $error->getCode() ? ' ' . $error->getCode() : '',
                            $error->getMessage()
                        )
                    );
                }

                $optimizer = (new Optimizer())
                    ->setRootNode($ast);

                $optimizer->execute();

                return $optimizer->getRootNode();
            }
        )
            ->call($type);
    }

    /**
     * @param \Zheltikov\TypeAssert\Parser\Node $ast
     * @return callable
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    protected static function astToCheckerFn(Node $ast): callable
    {
        switch ($ast->getType()->getKey()) {
            case Type::UNION()->getKey():
                invariant($ast->hasChildren(), 'Union Node must have children.');

                $sub_fns = array_map(
                    function (Node $x): callable {
                        return self::astToCheckerFn($x);
                    },
                    $ast->getChildren()
                );

                return function (State $state, $value) use ($sub_fns): bool {
                    $state->pushFrame();

                    foreach ($sub_fns as $sub_fn) {
                        if ($sub_fn($state, $value)) {
                            $state->popFrame();
                            return true;
                        }
                    }

                    $state->appendReportStack(Message::UNION_MISMATCH());
                    return false;
                };

            case Type::INTERSECTION()->getKey():
                invariant($ast->hasChildren(), 'Intersection Node must have children.');

                $sub_fns = array_map(
                    function (Node $x): callable {
                        return self::astToCheckerFn($x);
                    },
                    $ast->getChildren()
                );

                return function (State $state, $value) use ($sub_fns): bool {
                    foreach ($sub_fns as $sub_fn) {
                        if (!$sub_fn($state, $value)) {
                            // TODO: specify which Intersection type
                            $state->appendReportStack(Message::INTERSECTION_MISMATCH());
                            return false;
                        }
                    }
                    return true;
                };

            case Type::NULLABLE()->getKey():
                invariant($ast->countChildren() === 1, 'Nullable Node must have exactly 1 child.');

                $new_ast = (new Node(Type::UNION()))
                    ->appendChildren(
                        [
                            new Node(Type::NULL()),
                            clone $ast->getChildAt(0),
                        ]
                    );

                return self::astToCheckerFn($new_ast);

            case Type::TUPLE()->getKey():
                invariant($ast->hasChildren(), 'Tuple Node must have children.');

                $count = $ast->countChildren();

                $sub_fns = array_map(
                    function (Node $x): callable {
                        return self::astToCheckerFn($x);
                    },
                    $ast->getChildren()
                );

                return function (State $state, $value) use ($sub_fns, $count): bool {
                    if (!is_array($value)) {
                        $state->appendReportStack(Message::NOT_ARRAY());
                        return false;
                    }

                    $actual_count = count($value);
                    if ($actual_count !== $count) {
                        $state->appendReportStack(Message::TUPLE_WRONG_LENGTH(), $actual_count, $count);
                        return false;
                    }

                    $i = 0;
                    foreach ($value as $index => $item) {
                        if ($index !== $i) {
                            $state->appendReportStack(Message::TUPLE_INVALID_KEY(), var_export($index, true));
                            return false;
                        }

                        if (!$sub_fns[$i]($state, $item)) {
                            $state->appendReportStack(Message::TUPLE_INVALID_CHILD(), $i);
                            return false;
                        }

                        $i++;
                    }

                    return true;
                };

            case Type::SHAPE()->getKey():
                invariant($ast->hasChildren(), 'Shape Node must have children.');

                $children = $ast->getChildren();
                $count = 0;
                $count_optional = 0;
                $sub_fns = [];
                $optional = [];
                $open_shape = false;

                foreach ($children as $child) {
                    if (!$open_shape && $child->getType()->equals(Type::ELLIPSIS())) {
                        // Shape is open
                        $open_shape = true;
                        continue;
                    }

                    invariant(
                        $child->getType()->equals(Type::KEY_VALUE_PAIR()),
                        'Shape Node child must be of type key-value pair.'
                    );

                    invariant(
                        $child->countChildren() === 2,
                        'Shape Node key-value pair must have exactly 2 children.'
                    );

                    $raw_string = $child->getChildAt(0);
                    $type = $child->getChildAt(1);

                    if ($raw_string->getType()->equals(Type::RAW_STRING())) {
                        $key = $raw_string->getValue();

                        invariant(
                            $key !== null,
                            'Shape Node key node must have a value.'
                        );

                        // Check that key is not duplicated
                        invariant(
                            !array_key_exists($key, $sub_fns),
                            'Shape Node key must not be duplicated.'
                        );

                        $sub_fns[$key] = self::astToCheckerFn($type);
                        $count++;
                    } elseif ($raw_string->getType()->equals(Type::RAW_INTEGER())) {
                        $key = $raw_string->getValue();

                        invariant(
                            $key !== null,
                            'Shape Node key node must have a value.'
                        );

                        // Check that key is not duplicated
                        invariant(
                            !array_key_exists($key, $sub_fns),
                            'Shape Node key must not be duplicated.'
                        );

                        $sub_fns[$key] = self::astToCheckerFn($type);
                        $count++;
                    } elseif ($raw_string->getType()->equals(Type::OPTIONAL())) {
                        invariant(
                            $raw_string->countChildren() === 1,
                            'Shape Node optional key must have exactly 1 child.'
                        );

                        $inner = $raw_string->getChildAt(0);

                        invariant(
                            $inner->getType()->equals(Type::RAW_STRING())
                            || $inner->getType()->equals(Type::RAW_INTEGER()),
                            'Shape Node optional key type must be a raw string or a raw integer.'
                        );

                        $key = $inner->getValue();

                        invariant(
                            $key !== null,
                            'Shape Node optional key node must have a value.'
                        );

                        // Check that key is not duplicated
                        invariant(
                            !array_key_exists($key, $optional),
                            'Shape Node optional key must not be duplicated.'
                        );


                        $optional[$key] = self::astToCheckerFn($type);
                        $count_optional++;
                    } else {
                        invariant_violation(
                            'Shape Node key type must be a, maybe optional, raw string or raw integer.'
                        );
                    }
                }

                if ($count_optional === 0) {
                    return function (State $state, $value) use ($sub_fns, $count, $open_shape): bool {
                        if (!is_array($value)) {
                            // TODO: add support for Dicts
                            $state->appendReportStack(Message::NOT_ARRAY());
                            return false;
                        }

                        $actual_count = count($value);
                        if (!$open_shape) {
                            if ($actual_count !== $count) {
                                // Length does not match
                                $state->appendReportStack(
                                    Message::SHAPE_WRONG_LENGTH(),
                                    $actual_count,
                                    $count
                                );
                                return false;
                            }
                        } elseif ($actual_count < $count) {
                            // Length does not match
                            $state->appendReportStack(
                                Message::OPEN_SHAPE_WRONG_LENGTH(),
                                $actual_count,
                                $count
                            );
                            return false;
                        }

                        $keys = array_keys($sub_fns);

                        for ($i = 0; $i < $count; $i++) {
                            $key = $keys[$i];

                            if (!array_key_exists($key, $value)) {
                                // Required key is not set
                                $state->appendReportStack(Message::SHAPE_REQUIRED_KEY(), var_export($key, true));
                                return false;
                            }

                            if (!$sub_fns[$key]($state, $value[$key])) {
                                // Required type does not match
                                $state->appendReportStack(Message::SHAPE_WRONG_VALUE(), var_export($key, true));
                                return false;
                            }
                        }

                        return true;
                    };
                } else {
                    return function (State $state, $value) use (
                        $sub_fns,
                        $optional,
                        $count,
                        $count_optional,
                        $open_shape
                    ): bool {
                        if (!is_array($value)) {
                            // TODO: add support for Dicts
                            $state->appendReportStack(Message::NOT_ARRAY());
                            return false;
                        }

                        $actual_count = count($value);
                        if (!$open_shape) {
                            if (
                                !(
                                    $count <= $actual_count
                                    && $actual_count <= $count + $count_optional
                                )
                            ) {
                                // Length is not valid
                                $state->appendReportStack(
                                    Message::OPTIONAL_SHAPE_WRONG_LENGTH(),
                                    $actual_count,
                                    $count,
                                    $count + $count_optional
                                );
                                return false;
                            }
                        } elseif ($count > $actual_count) {
                            // Length is not valid
                            $state->appendReportStack(
                                Message::OPEN_OPTIONAL_SHAPE_WRONG_LENGTH(),
                                $actual_count,
                                $count
                            );
                            return false;
                        }

                        foreach ($value as $key => $sub_value) {
                            if (array_key_exists($key, $sub_fns)) {
                                if (!$sub_fns[$key]($state, $sub_value)) {
                                    // Required type does not match
                                    $state->appendReportStack(
                                        Message::SHAPE_WRONG_VALUE(),
                                        var_export($key, true)
                                    );
                                    return false;
                                }
                                continue;
                            }

                            if (array_key_exists($key, $optional)) {
                                if (!$optional[$key]($state, $sub_value)) {
                                    // Optional type does not match
                                    $state->appendReportStack(
                                        Message::SHAPE_WRONG_VALUE(),
                                        var_export($key, true)
                                    );
                                    return false;
                                }
                                continue;
                            }

                            if (!$open_shape) {
                                // Key is invalid as it is not either in required
                                // nor in optional keys
                                $state->appendReportStack(
                                    Message::SHAPE_INVALID_KEY(),
                                    var_export($key, true)
                                );
                                return false;
                            }
                        }

                        return true;
                    };
                }

            case Type::KEY_VALUE_PAIR()->getKey():
            case Type::OPTIONAL()->getKey():
            case Type::ELLIPSIS()->getKey():
            case Type::GENERIC_LIST()->getKey():
            case Type::LIST()->getKey():
                break;

            case Type::BOOL()->getKey():
                return function (State $state, $value): bool {
                    if (is_bool($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_BOOL());
                        return false;
                    }
                };

            case Type::INT()->getKey():
                return function (State $state, $value): bool {
                    if (is_int($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_INT());
                        return false;
                    }
                };

            case Type::FLOAT()->getKey():
                return function (State $state, $value): bool {
                    if (is_float($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_FLOAT());
                        return false;
                    }
                };

            case Type::STRING()->getKey():
                return function (State $state, $value): bool {
                    if (is_string($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_STRING());
                        return false;
                    }
                };

            case Type::ARRAY()->getKey():
                $child_count = $ast->countChildren();

                if ($child_count === 0) {
                    return function (State $state, $value): bool {
                        if (is_array($value)) {
                            return true;
                        } else {
                            $state->appendReportStack(Message::EXPECTED_ARRAY());
                            return false;
                        }
                    };
                } elseif ($child_count === 1) {
                    $child = $ast->getChildAt(0);

                    invariant(
                        $child->getType()->equals(Type::GENERIC_LIST()),
                        'Array child must be a generic list.'
                    );

                    $generic_count = $child->countChildren();

                    if ($generic_count === 0) {
                        return function (State $state, $value): bool {
                            if (is_array($value)) {
                                return true;
                            } else {
                                $state->appendReportStack(Message::EXPECTED_ARRAY());
                                return false;
                            }
                        };
                    } elseif ($generic_count === 1) {
                        // value check
                        $value_fn = self::astToCheckerFn($child->getChildAt(0));

                        return function (State $state, $value) use ($value_fn): bool {
                            if (!is_array($value)) {
                                $state->appendReportStack(Message::NOT_ARRAY());
                                return false;
                            }

                            $i = 0;
                            foreach ($value as $index => $item) {
                                if (!$value_fn($state, $item)) {
                                    if ($index === $i) {
                                        $state->appendReportStack(Message::ARRAY_INVALID_INDEX_CHILD(), $i);
                                    } else {
                                        $state->appendReportStack(
                                            Message::ARRAY_INVALID_KEY_CHILD(),
                                            var_export($index, true)
                                        );
                                    }
                                    return false;
                                }
                                $i++;
                            }

                            return true;
                        };
                    } elseif ($generic_count === 2) {
                        // key-value check
                        $key_fn = self::astToCheckerFn($child->getChildAt(0));
                        $value_fn = self::astToCheckerFn($child->getChildAt(1));

                        return function (State $state, $value) use ($key_fn, $value_fn): bool {
                            if (!is_array($value)) {
                                $state->appendReportStack(Message::NOT_ARRAY());
                                return false;
                            }

                            foreach ($value as $key => $item) {
                                if (!$key_fn($state, $key)) {
                                    $state->appendReportStack(Message::ARRAY_INVALID_KEY(), var_export($key, true));
                                    return false;
                                }
                                if (!$value_fn($state, $item)) {
                                    $state->appendReportStack(
                                        Message::ARRAY_INVALID_KEY_CHILD(),
                                        var_export($key, true)
                                    );
                                    return false;
                                }
                            }

                            return true;
                        };
                    }

                    invariant_violation(
                        'Array generic list can have 0, 1 or 2 children; got %d children.',
                        $generic_count
                    );
                }

                invariant_violation('Array type can have 0 or 1 children.');
                break; // this break is unnecessary

            case Type::OBJECT()->getKey():
                return function (State $state, $value): bool {
                    if (is_object($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_OBJECT());
                        return false;
                    }
                };

            case Type::CALLABLE()->getKey():
                return function (State $state, $value): bool {
                    if (is_callable($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_CALLABLE());
                        return false;
                    }
                };

            case Type::ITERABLE()->getKey():
                return function (State $state, $value): bool {
                    if (is_iterable($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_ITERABLE());
                        return false;
                    }
                };

            case Type::RESOURCE()->getKey():
                return function (State $state, $value): bool {
                    if (is_resource($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_RESOURCE());
                        return false;
                    }
                };

            case Type::NULL()->getKey():
                return function (State $state, $value): bool {
                    if ($value === null) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_NULL());
                        return false;
                    }
                };

            case Type::NEGATED()->getKey():
                invariant($ast->countChildren() === 1, 'Negated Node must have exactly 1 child.');

                $fn = self::astToCheckerFn($ast->getChildAt(0));

                return function (State $state, $value) use ($fn): bool {
                    if (!$fn($state, $value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::NEGATED_MISMATCH());
                        return false;
                    }
                };

            case Type::USER_DEFINED()->getKey():
                $type = $ast->getValue();

                invariant(
                    class_exists($type) || interface_exists($type),
                    'User-defined type must exist.'
                );

                return function (State $state, $value) use ($type): bool {
                    // TODO: instanceof doesn't work with traits :(
                    if ($value instanceof $type) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::NOT_INSTANCEOF(), $type);
                        return false;
                    }
                };

            case Type::ARRAYKEY()->getKey():
                $new_ast = (new Node(Type::UNION()))
                    ->appendChildren(
                        [
                            new Node(Type::STRING()),
                            new Node(Type::INT()),
                        ]
                    );

                return self::astToCheckerFn($new_ast);

            case Type::NOT_NULL()->getKey():
                $new_ast = (new Node(Type::NEGATED()))
                    ->appendChild(
                        new Node(Type::NULL()),
                    );

                return self::astToCheckerFn($new_ast);

            case Type::SCALAR()->getKey():
                return function (State $state, $value): bool {
                    if (is_scalar($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_SCALAR());
                        return false;
                    }
                };

            case Type::NUMBER()->getKey():
                $new_ast = (new Node(Type::UNION()))
                    ->appendChildren(
                        [
                            new Node(Type::INT()),
                            new Node(Type::FLOAT()),
                        ]
                    );

                return self::astToCheckerFn($new_ast);

            case Type::MIXED()->getKey():
                return function (): bool {
                    return true;
                };

            case Type::VOID()->getKey():
                return function (State $state): bool {
                    $state->appendReportStack(Message::NOT_VOID());
                    return false;
                };

            // TODO: stuff from php-arrays...

            case Type::NOT_EMPTY()->getKey():
                $new_ast = (new Node(Type::NEGATED()))
                    ->appendChild(
                        new Node(Type::EMPTY()),
                    );

                return self::astToCheckerFn($new_ast);

            case Type::EMPTY()->getKey():
                return function (State $state, $value): bool {
                    if (empty($value)) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_EMPTY());
                        return false;
                    }
                };

            case Type::TRUE()->getKey():
                return function (State $state, $value): bool {
                    if ($value === true) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_TRUE());
                        return false;
                    }
                };

            case Type::FALSE()->getKey():
                return function (State $state, $value): bool {
                    if ($value === false) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_FALSE());
                        return false;
                    }
                };

            case Type::POSITIVE()->getKey():
                return function (State $state, $value): bool {
                    if ($value > 0) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_POSITIVE());
                        return false;
                    }
                };

            case Type::NEGATIVE()->getKey():
                return function (State $state, $value): bool {
                    if ($value < 0) {
                        return true;
                    } else {
                        $state->appendReportStack(Message::EXPECTED_NEGATIVE());
                        return false;
                    }
                };

            case Type::RAW_STRING()->getKey():
                $raw_string = $ast->getValue();

                invariant($raw_string !== null, 'Raw string Node must have a value.');

                return function (State $state, $value) use ($raw_string): bool {
                    if ($value === $raw_string) {
                        return true;
                    } else {
                        $state->appendReportStack(
                            Message::MATCH_STRING(),
                            var_export($raw_string, true)
                        );
                        return false;
                    }
                };

            case Type::RAW_INTEGER()->getKey():
                $raw_integer = $ast->getValue();

                invariant($raw_integer !== null, 'Raw integer Node must have a value.');

                return function (State $state, $value) use ($raw_integer): bool {
                    if ($value === $raw_integer) {
                        return true;
                    } else {
                        $state->appendReportStack(
                            Message::MATCH_INT(),
                            $raw_integer
                        );
                        return false;
                    }
                };

            case Type::RAW_FLOAT()->getKey():
                $raw_float = $ast->getValue();

                invariant($raw_float !== null, 'Raw float Node must have a value.');

                return function (State $state, $value) use ($raw_float): bool {
                    if ($value === $raw_float) {
                        return true;
                    } else {
                        $state->appendReportStack(
                            Message::MATCH_FLOAT(),
                            $raw_float
                        );
                        return false;
                    }
                };

            case Type::REGEX_STRING()->getKey():
                invariant($ast->countChildren() === 1, 'Regex String Node must have exactly 1 child.');

                $inner = $ast->getChildAt(0);

                invariant(
                    $inner->getType()->equals(Type::RAW_STRING()),
                    'Regex String Node, child type must be a raw string.'
                );

                $pattern = $inner->getValue();

                invariant(
                    $pattern !== null,
                    'Regex String Node, raw string node must have a value.'
                );

                return function (State $state, $value) use ($pattern): bool {
                    if (!is_string($value)) {
                        $state->appendReportStack(Message::EXPECTED_STRING());
                    }

                    if (preg_match($pattern, $value)) {
                        return true;
                    }

                    $state->appendReportStack(
                        Message::MATCH_REGEX(),
                        var_export($pattern, true)
                    );

                    return false;
                };

            case Type::FORMAT_STRING()->getKey():
                invariant($ast->countChildren() === 1, 'Format String Node must have exactly 1 child.');

                $inner = $ast->getChildAt(0);

                invariant(
                    $inner->getType()->equals(Type::RAW_STRING()),
                    'Format String Node, child type must be a raw string.'
                );

                $pattern = $inner->getValue();

                invariant(
                    $pattern !== null,
                    'Format String Node, raw string node must have a value.'
                );

                return function (State $state, $value) use ($pattern): bool {
                    if (!is_string($value)) {
                        $state->appendReportStack(Message::EXPECTED_STRING());
                    }

                    $result = sscanf($value, $pattern);
                    if ($result === null) {
                        $state->appendReportStack(
                            Message::MATCH_FORMAT(),
                            var_export($pattern, true)
                        );
                        return false;
                    }

                    $state->pushFrame();
                    $n = 0;
                    foreach ($result as $index => $subresult) {
                        if ($subresult === null) {
                            $state->appendReportStack(Message::EXPECTED_MATCH_PLACEHOLDER(), $index);
                            $n++;
                        }
                    }

                    if ($n > 0) {
                        $state->appendReportStack(Message::NON_MATCHING_PLACEHOLDERS(), $n);
                        return false;
                    }

                    $state->popFrame();
                    return true;
                };

            case Type::INTABLE()->getKey():
                return function (State $state, $value): bool {
                    if (!is_numeric($value)) {
                        return false;
                    }

                    $normalized = (string) (int) $value;

                    if ($normalized !== (string) $value) {
                        return false;
                    }

                    return true;
                };

            default:
                throw new InvalidArgumentException(
                    sprintf(
                        'Unknown Node type %s%s',
                        $ast->getType()->getKey(),
                        $ast->getValue() !== null
                            ? ' with value ' . ((string) $ast->getValue())
                            : ''
                    )
                );
        }

        throw new RuntimeException(
            sprintf(
                'Handling of type %s not yet implemented!',
                $ast->getType()->getKey()
            )
        );
    }
}
