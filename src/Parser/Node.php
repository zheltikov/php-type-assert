<?php

namespace Zheltikov\TypeAssert\Parser;

class Node
{
    /**
     * @var Type
     */
    private $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }
}
