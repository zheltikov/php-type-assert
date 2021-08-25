<?php

namespace Zheltikov\TypeAssert;

use InvalidArgumentException;
use RuntimeException;
use Throwable;
use Zheltikov\TypeAssert\Parser\{Lexer, Node, Optimizer, Type, Types};

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

                $debug = true; // TODO: disable debug

                if ($debug) {
                    echo '<b>&gt;&gt;&gt;</b> ', $ast->prettyHtml(), "\n\n";
                }

                $optimizer = (new Optimizer())
                    // ->setDebug($debug) // TODO: disable debug
                    ->setRootNode($ast);

                $optimizer->execute();
                $ast = $optimizer->getRootNode();

                if ($debug) {
                    echo '<b>&gt;&gt;&gt;</b> ', $ast->prettyHtml(), "\n\n";
                }

                return $ast;
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

                return function ($value, array &$report_stack = []) use ($sub_fns): bool {
                    foreach ($sub_fns as $sub_fn) {
                        if ($sub_fn($value, $report_stack)) {
                            return true;
                        }
                    }

                    $report_stack[] = 'Value does not satisfy any of the types in the Union';
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

                return function ($value, array &$report_stack = []) use ($sub_fns): bool {
                    foreach ($sub_fns as $sub_fn) {
                        if (!$sub_fn($value, $report_stack)) {
                            $report_stack[] = 'Value does not satisfy type in Intersection';
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

                return function ($value, array &$report_stack = []) use ($sub_fns, $count): bool {
                    if (!is_array($value)) {
                        $report_stack[] = 'Value is not an array';
                        return false;
                    }

                    if (count($value) !== $count) {
                        $report_stack[] = 'Tuple has wrong length';
                        return false;
                    }

                    $i = 0;
                    foreach ($value as $index => $item) {
                        if ($index !== $i) {
                            $report_stack[] = 'Tuple has a key mismatch (probably not 0-indexed)';
                            return false;
                        }

                        if (!$sub_fns[$i]($item, $report_stack)) {
                            $report_stack[] = 'Tuple has a type mismatch in child element';
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
                    } elseif ($raw_string->getType()->equals(Type::OPTIONAL())) {
                        invariant(
                            $raw_string->countChildren() === 1,
                            'Shape Node optional key must have exactly 1 child.'
                        );

                        $inner = $raw_string->getChildAt(0);

                        invariant(
                            $inner->getType()->equals(Type::RAW_STRING()),
                            'Shape Node optional key type must be a raw string.'
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
                            'Shape Node key type must be a, maybe optional, raw string.'
                        );
                    }
                }

                if ($count_optional === 0) {
                    return function ($value, array &$report_stack = []) use ($sub_fns, $count, $open_shape): bool {
                        if (!is_array($value)) {
                            // TODO: add support for Dicts
                            $report_stack[] = 'Value is not an array';
                            return false;
                        }

                        if (!$open_shape) {
                            if (count($value) !== $count) {
                                // Length does not match
                                $report_stack[] = 'Shape element count mismatch';
                                return false;
                            }
                        } elseif (count($value) < $count) {
                            // Length does not match
                            $report_stack[] = 'Open shape element count mismatch';
                            return false;
                        }

                        $keys = array_keys($sub_fns);

                        for ($i = 0; $i < $count; $i++) {
                            $key = $keys[$i];

                            if (!array_key_exists($key, $value)) {
                                // Required key is not set
                                $report_stack[] = 'Required shape key is not set';
                                return false;
                            }

                            if (!$sub_fns[$key]($value[$key])) {
                                // Required type does not match
                                $report_stack[] = 'Shape value type mismatch';
                                return false;
                            }
                        }

                        return true;
                    };
                } else {
                    return function ($value, array &$report_stack = []) use (
                        $sub_fns,
                        $optional,
                        $count,
                        $count_optional,
                        $open_shape
                    ): bool {
                        if (!is_array($value)) {
                            // TODO: add support for Dicts
                            $report_stack[] = 'Value is not an array';
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
                                $report_stack[] = 'Shape element count mismatch';
                                return false;
                            }
                        } elseif ($count > $actual_count) {
                            // Length is not valid
                            $report_stack[] = 'Shape has too much elements';
                            return false;
                        }

                        foreach ($value as $key => $sub_value) {
                            if (array_key_exists($key, $sub_fns)) {
                                if (!$sub_fns[$key]($sub_value)) {
                                    // Required type does not match
                                    $report_stack[] = 'Shape required value type mismatch';
                                    return false;
                                }
                                continue;
                            }

                            if (array_key_exists($key, $optional)) {
                                if (!$optional[$key]($sub_value)) {
                                    // Optional type does not match
                                    $report_stack[] = 'Shape optional value type mismatch';
                                    return false;
                                }
                                continue;
                            }

                            if (!$open_shape) {
                                // Key is invalid as it is not either in required
                                // nor in optional keys
                                $report_stack[] = 'Shape has invalid key (probably an open shape would fix this)';
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
                return function ($value, array &$report_stack = []): bool {
                    if (is_bool($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be bool';
                        return false;
                    }
                };

            case Type::INT()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if (is_int($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be int';
                        return false;
                    }
                };

            case Type::FLOAT()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if (is_float($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be float';
                        return false;
                    }
                };

            case Type::STRING()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if (is_string($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be string';
                        return false;
                    }
                };

            case Type::ARRAY()->getKey():
                $child_count = $ast->countChildren();

                if ($child_count === 0) {
                    return function ($value, array &$report_stack = []): bool {
                        if (is_array($value)) {
                            return true;
                        } else {
                            $report_stack[] = 'Value expected to be array';
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
                        return function ($value, array &$report_stack = []): bool {
                            if (is_array($value)) {
                                return true;
                            } else {
                                $report_stack[] = 'Value expected to be array';
                                return false;
                            }
                        };
                    } elseif ($generic_count === 1) {
                        // value check
                        $value_fn = self::astToCheckerFn($child->getChildAt(0));

                        return function ($value, array &$report_stack = []) use ($value_fn): bool {
                            if (!is_array($value)) {
                                $report_stack[] = 'Value is not an array';
                                return false;
                            }

                            foreach ($value as $item) {
                                if (!$value_fn($item)) {
                                    $report_stack[] = 'Array value type mismatch';
                                    return false;
                                }
                            }

                            return true;
                        };
                    } elseif ($generic_count === 2) {
                        // key-value check
                        $key_fn = self::astToCheckerFn($child->getChildAt(0));
                        $value_fn = self::astToCheckerFn($child->getChildAt(1));

                        return function ($value, array &$report_stack = []) use ($key_fn, $value_fn): bool {
                            if (!is_array($value)) {
                                $report_stack[] = 'Value is not an array';
                                return false;
                            }

                            foreach ($value as $key => $item) {
                                if (!$key_fn($key)) {
                                    $report_stack[] = 'Array key type mismatch';
                                    return false;
                                }
                                if (!$value_fn($item)) {
                                    $report_stack[] = 'Array value type mismatch';
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
                return function ($value, array &$report_stack = []): bool {
                    if (is_object($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be object';
                        return false;
                    }
                };

            case Type::CALLABLE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if (is_callable($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be callable';
                        return false;
                    }
                };

            case Type::ITERABLE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if (is_iterable($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be iterable';
                        return false;
                    }
                };

            case Type::RESOURCE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if (is_resource($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be resource';
                        return false;
                    }
                };

            case Type::NULL()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if ($value === null) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be null';
                        return false;
                    }
                };

            case Type::NEGATED()->getKey():
                invariant($ast->countChildren() === 1, 'Negated Node must have exactly 1 child.');

                $fn = self::astToCheckerFn($ast->getChildAt(0));

                return function ($value, array &$report_stack = []) use ($fn): bool {
                    if (!$fn($value, $report_stack)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value type mismatch (negated type)';
                        return false;
                    }
                };

            case Type::USER_DEFINED()->getKey():
                $type = $ast->getValue();

                invariant(
                    class_exists($type) || interface_exists($type),
                    'User-defined type must exist.'
                );

                return function ($value, array &$report_stack = []) use ($type): bool {
                    // TODO: instanceof doesn't work with traits :(
                    if ($value instanceof $type) {
                        return true;
                    } else {
                        $report_stack[] = sprintf('Value is not instanceof %s', $type);
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
                return function ($value, array &$report_stack = []): bool {
                    if (is_scalar($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be scalar';
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
                return function (): bool {
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
                return function ($value, array &$report_stack = []): bool {
                    if (empty($value)) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be empty';
                        return false;
                    }
                };

            case Type::TRUE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if ($value === true) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be true';
                        return false;
                    }
                };

            case Type::FALSE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if ($value === false) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be false';
                        return false;
                    }
                };

            case Type::POSITIVE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if ($value > 0) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be positive';
                        return false;
                    }
                };

            case Type::NEGATIVE()->getKey():
                return function ($value, array &$report_stack = []): bool {
                    if ($value < 0) {
                        return true;
                    } else {
                        $report_stack[] = 'Value expected to be negative';
                        return false;
                    }
                };

            case Type::RAW_STRING()->getKey():
                $raw_string = $ast->getValue();

                invariant($raw_string !== null, 'Raw string Node must have a value.');

                return function ($value, array &$report_stack = []) use ($raw_string): bool {
                    if ($value === $raw_string) {
                        return true;
                    } else {
                        $report_stack[] = sprintf('Value expected to be exactly %s', $raw_string);
                        return false;
                    }
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
