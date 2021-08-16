<?php

namespace Zheltikov\TypeAssert\Parser;

class Optimizer
{
    /**
     * @var array|null
     */
    protected static $aliases = null;

    /**
     * @var \Zheltikov\TypeAssert\Parser\Node
     */
    protected $root_node;

    /**
     * @var bool
     */
    protected $debug = false;

    /**
     * @param \Zheltikov\TypeAssert\Parser\Node|null $root_node
     * @param bool $debug
     */
    public function __construct(?Node $root_node = null, bool $debug = false)
    {
        if ($root_node !== null) {
            $this->setRootNode($root_node);
        }
        $this->debug = $debug;
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        if (static::$aliases === null) {
            static::$aliases = static::initAliases();
        }
        return static::$aliases;
    }

    /**
     * @return array
     */
    protected static function initAliases(): array
    {
        return [
            Type::ARRAYKEY()->getKey() => function (Node &$node): void {
                $new_node = new Node(Type::UNION());
                $new_node->appendChildren(
                    [
                        new Node(Type::STRING()),
                        new Node(Type::INT()),
                    ]
                );
                $node = $new_node;
            },
        ];
    }

    /**
     * @param \Zheltikov\TypeAssert\Parser\Node|null $root_node
     * @return $this
     */
    public function setRootNode(?Node $root_node = null): self
    {
        if ($root_node !== null) {
            $this->root_node = $root_node;
        }

        return $this;
    }

    /**
     * @return \Zheltikov\TypeAssert\Parser\Node
     */
    public function getRootNode(): Node
    {
        return $this->root_node;
    }

    public function execute(): void
    {
        // return;

        $serialize = function () {
            return $this->isDebug()
                ? $this->root_node->pretty()
                : json_encode($this->root_node);
        };

        if ($this->isDebug()) {
            echo 'Unoptimized: ', $serialize(), "\n";
        }

        $serialized = '';
        $i = 0;

        while ($serialized !== $serialize()) {
            $serialized = $serialize();

            $this->unwrapAliases();
            $this->unwrapNegations();
            $this->unwrapUnions();
            $this->dedupeUnions();
            $this->nullableToUnion();

            if ($this->isDebug()) {
                echo 'Optimized:   ', $serialize(), "\n";
            }

            $i++;
        }

        if ($this->isDebug()) {
            echo $i, " optimization iterations.\n";
        }
    }

    // -------------------------------------------------------------------------

    /**
     * Done.
     */
    protected function unwrapAliases(): void
    {
        $types = Type::values();

        /** @var callable $resolver */
        foreach (static::getAliases() as $alias => $resolver) {
            $type = $types[$alias];

            if ($this->root_node->getType()->equals($type)) {
                $node =& $this->root_node;
            } else {
                $node =& $this->root_node->getFirstByType($type);
            }

            if ($node !== null) {
                $resolver($node);
            }

            unset($node);
        }
    }

    /**
     * Done.
     */
    protected function unwrapNegations(): void
    {
        if ($this->root_node->getType()->equals(Type::NEGATED())) {
            $node =& $this->root_node;
        } else {
            $node =& $this->root_node->getFirstByType(Type::NEGATED());
        }

        if ($node !== null) {
            $children =& $node->getChildren();

            assert(
                $node->countChildren() === 1,
                'Negation Node must have exactly 1 child'
            );

            if ($children[0]->getType()->equals(Type::NEGATED())) {
                $sub_children =& $children[0]->getChildren();

                assert(
                    $children[0]->countChildren() === 1,
                    'Negation Sub-Node must have exactly 1 child'
                );

                $new_node = new Node(Type::NEGATED());
                $new_node->appendChild($sub_children[0]);

                $node = $sub_children[0];
            }
        }
    }

    /**
     * Done.
     */
    protected function unwrapUnions(): void
    {
        if ($this->root_node->getType()->equals(Type::UNION())) {
            $node =& $this->root_node;
        } else {
            $node =& $this->root_node->getFirstByType(Type::UNION());
        }

        if ($node !== null) {
            if ($node->hasChildOfType(Type::UNION())) {
                $new_node = new Node(Type::UNION());

                $children =& $node->getChildren();
                foreach ($children as $child) {
                    if ($child->getType()->equals(Type::UNION())) {
                        $sub_children =& $child->getChildren();
                        $new_node->appendChildren($sub_children);
                        // $delete_children[] = $child;
                    } else {
                        $new_node->appendChild($child);
                    }
                }

                $node = $new_node;
            }
        }
    }

    /**
     * Done.
     * FIXME: Test with: ??tuple(string, int)
     */
    protected function dedupeUnions(): void
    {
        if ($this->root_node->getType()->equals(Type::UNION())) {
            $node =& $this->root_node;
        } else {
            $node =& $this->root_node->getFirstByType(Type::UNION());
        }

        if ($node !== null) {
            $counter_map = [];
            $needs_optimization = false;

            $children =& $node->getChildren();
            foreach ($children as &$child) {
                $child_count = $child->countChildren();
                if ($child_count > 0) {
                    continue;
                }

                $type = $child->getType()->getKey();
                if (array_key_exists($type, $counter_map)) {
                    $counter_map[$type]++;
                    $needs_optimization = true;
                } else {
                    $counter_map[$type] = 1;
                }
            }

            if ($needs_optimization) {
                $just_added = [];
                $new_node = new Node(Type::UNION());

                unset($child);
                foreach ($children as &$child) {
                    $child_count = $child->countChildren();
                    if ($child_count > 0) {
                        $new_node->appendChild($child);
                    }

                    $type = $child->getType()->getKey();
                    if (array_key_exists($type, $counter_map)) {
                        if (!array_key_exists($type, $just_added)) {
                            $new_node->appendChild($child);
                            $just_added[$type] = 1;
                        }
                    } else {
                        $new_node->appendChild($child);
                    }
                }

                $node = $new_node;
            }
        }
    }

    /**
     * Done.
     */
    protected function nullableToUnion(): void
    {
        if ($this->root_node->getType()->equals(Type::NULLABLE())) {
            $node =& $this->root_node;
        } else {
            $node =& $this->root_node->getFirstByType(Type::NULLABLE());
        }

        if ($node !== null) {
            $null = new Node(Type::NULL());
            $children =& $node->getChildren();

            $new_node = (new Node(Type::UNION()))
                ->appendChild($null)
                ->appendChildren($children);

            $node = $new_node;
        }
    }

    // -------------------------------------------------------------------------

    /**
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     * @return $this
     */
    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }
}
