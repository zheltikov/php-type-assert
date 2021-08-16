<?php

namespace Zheltikov\TypeAssert\Parser;

class Node implements \JsonSerializable
{
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var \Zheltikov\TypeAssert\Parser\Node[]
     */
    protected $children;

    public function __construct(Type $type)
    {
        $this->type = $type;
        $this->children = [];
    }

    /**
     * @param \Zheltikov\TypeAssert\Parser\Node|null $child
     * @return $this
     */
    public function appendChild(?Node $child = null): self
    {
        if ($child !== null) {
            $this->children[] = $child;
        }

        return $this;
    }

    /**
     * @param iterable|null $children
     * @return $this
     */
    public function appendChildren(?iterable $children = null): self
    {
        if ($children !== null) {
            foreach ($children as $child) {
                $this->appendChild($child);
            }
        }

        return $this;
    }

    /**
     * @return \Zheltikov\TypeAssert\Parser\Node[]
     */
    public function &getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type->getKey(),
            'children' => $this->children,
        ];
        /*return [
            $this->type->getKey(),
            ...$this->children,
        ];*/
    }

    /**
     * @param \Zheltikov\TypeAssert\Parser\Type $type
     * @return \Zheltikov\TypeAssert\Parser\Node|null
     */
    public function &getFirstByType(Type $type): ?Node
    {
        /** @var \Zheltikov\TypeAssert\Parser\Node $child */
        foreach ($this->children as &$child) {
            if ($child->getType()->equals($type)) {
                return $child;
            }

            if ($child->hasChildren()) {
                $result =& $child->getFirstByType($type);
                if ($result !== null) {
                    return $result;
                }
            }
        }

        $result = null;
        return $result;
    }

    /**
     * @return \Zheltikov\TypeAssert\Parser\Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @param \Zheltikov\TypeAssert\Parser\Type $type
     * @return bool
     */
    public function hasChildOfType(Type $type): bool
    {
        foreach ($this->children as $child) {
            if ($child->getType()->equals($type)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \Zheltikov\TypeAssert\Parser\Node $child
     * @return $this
     */
    public function deleteChild(Node $child): self
    {
        $new_children = [];

        foreach ($this->children as $_child) {
            if ($child !== $_child) {
                $new_children[] = $_child;
            }
        }

        $this->children = $new_children;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return $this->countChildren() > 0;
    }

    /**
     * @return int
     */
    public function countChildren(): int
    {
        return count($this->children);
    }

    /**
     * @return string
     */
    public function pretty(): string
    {
        $result = $this->type->getValue();
        $child_count = $this->countChildren();

        if ($child_count > 0) {
            $result .= '<';

            foreach ($this->children as $index => $child) {
                $result .= $child->pretty();

                if ($index + 1 < $child_count) {
                    $result .= ', ';
                }
            }

            $result .= '>';
        }

        return $result;
    }
}
