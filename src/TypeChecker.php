<?php

namespace Zheltikov\TypeAssert;

use InvalidArgumentException;
use RuntimeException;
use Throwable;
use Zheltikov\Memoize;
use Zheltikov\TypeAssert\Parser\{Lexer, Node, Optimizer, Type, Types};

use function Zheltikov\Invariant\invariant;

/**
 * Class TypeChecker
 * @package Zheltikov\Invariant\TypeAssert
 */
final class TypeChecker
{
    use Memoize\Helper;

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
        $fn = self::astToCheckerFn($ast);

        // invariant_violation('Unknown type %s provided.', $type);

        return $fn;
    }

    /**
     * @param string $type
     * @return \Zheltikov\TypeAssert\Parser\Node
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    protected static function parseType(string $type): Node
    {
        /** @var callable|null $fn */
        static $fn = null;

        return self::memoize(
            $fn,
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
                    ->setDebug(true) // TODO: remove debug
                    ->setRootNode($ast);

                $optimizer->execute();

                return $optimizer->getRootNode();
            },
            $type
        );
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

                return function ($value) use ($sub_fns): bool {
                    foreach ($sub_fns as $sub_fn) {
                        if ($sub_fn($value)) {
                            return true;
                        }
                    }
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

                return function ($value) use ($sub_fns): bool {
                    foreach ($sub_fns as $sub_fn) {
                        if (!$sub_fn($value)) {
                            return false;
                        }
                    }
                    return true;
                };

            case Type::NULLABLE()->getKey():
                invariant($ast->countChildren() === 1, 'Nullable Node must have exactly 1 child.');

                $new_ast = (new Node(Type::UNION()))
                    ->appendChild(new Node(Type::NULL()))
                    ->appendChild($ast->getChildAt(0));

                return self::astToCheckerFn($new_ast);

            default:
                throw new InvalidArgumentException(
                    sprintf(
                        'Unknown Node type: %s',
                        $ast->getType()->getKey()
                    )
                );
        }
    }
}
