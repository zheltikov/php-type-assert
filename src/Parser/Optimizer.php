<?php

namespace Zheltikov\TypeAssert\Parser;

class Optimizer
{
    /**
     * @var \Zheltikov\TypeAssert\Parser\Node
     */
    protected $root_node;

    /**
     * @param \Zheltikov\TypeAssert\Parser\Node|null $root_node
     */
    public function __construct(?Node $root_node = null)
    {
        if ($root_node !== null) {
            $this->setRootNode($root_node);
        }
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
            // return json_encode($this->root_node);
            return $this->root_node->pretty();
        };

        echo 'Unoptimized:  ', $serialize(), "\n";

        $serialized = '';
        $i = 0;

        while ($serialized !== $serialize()) {
            $serialized = $serialize();

            $this->unwrapNegations();
            // $this->unwrapUnions();
            // $this->dedupeUnions();
            // $this->nullableToUnion();

            echo 'Intermediate: ', $serialize(), "\n";
            $i++;
        }

        echo 'Optimized:    ', $serialize(), "\n";
        echo $i, " optimization iterations.\n";
    }

    // -------------------------------------------------------------------------

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

                // $delete_children = [];
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

                /*foreach ($delete_children as $child) {
                    $node->deleteChild($child);
                }*/

                $node = $new_node;
            }
        }
    }

    protected function dedupeUnions(): void
    {
    }

    protected function nullableToUnion(): void
    {
    }
}
