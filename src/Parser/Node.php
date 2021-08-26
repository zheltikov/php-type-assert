<?php

namespace Zheltikov\TypeAssert\Parser;

use JsonSerializable;

class Node implements JsonSerializable
{
    /**
     * @var Type
     */
    protected Type $type;

    /**
     * @var \Zheltikov\TypeAssert\Parser\Node[]
     */
    protected array $children;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param \Zheltikov\TypeAssert\Parser\Type|null $type
     * @param null $value
     */
    public function __construct(?Type $type = null, $value = null)
    {
        $this->setType($type)
            ->setValue($value);
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
     * @param \Zheltikov\TypeAssert\Parser\Node|null $child
     * @return $this
     */
    public function prependChild(?Node $child = null): self
    {
        if ($child !== null) {
            array_unshift($this->children, $child);
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
     * @param int $index
     * @return \Zheltikov\TypeAssert\Parser\Node|null
     */
    public function &getChildAt(int $index): ?Node
    {
        $i = 0;
        foreach ($this->getChildren() as &$child) {
            if ($index === $i) {
                return $child;
            }
            $i++;
        }
        unset($child);

        $child = null;
        return $child;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type->getKey(),
            'value' => $this->value,
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
     * @param \Zheltikov\TypeAssert\Parser\Type|null $type
     * @return $this
     */
    public function setType(?Type $type = null): self
    {
        if ($type !== null) {
            $this->type = $type;
        }

        return $this;
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

        if ($this->value !== null) {
            $result .= '(' . ((string) $this->value) . ')';
        }

        $child_count = $this->countChildren();
        if ($child_count > 0) {
            $result .= '<' . "\n";

            foreach ($this->children as $index => $child) {
                $result .= implode(
                    "\n",
                    array_map(
                        function (string $line): string {
                            return "\t" . $line;
                        },
                        explode("\n", $child->pretty())
                    )
                );

                if ($index + 1 < $child_count) {
                    $result .= ', ' . "\n";
                }
            }

            $result .= "\n" . '>';
        }

        return $result;
    }

    /**
     * @return string
     */
    public function prettyHtml(): string
    {
        return htmlspecialchars($this->pretty());
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param iterable|null $children
     * @return $this
     */
    public function prependChildren(?iterable $children = null): self
    {
        if ($children !== null) {
            foreach ($children as $child) {
                $this->prependChild($child);
            }
        }

        return $this;
    }
}
