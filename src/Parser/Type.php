<?php

namespace Zheltikov\TypeAssert\Parser;

use MyCLabs\Enum\Enum;

/**
 * Class Type
 * @package Zheltikov\TypeAssert\Parser
 *
 * @extends Enum<Type>
 *
 * @method Type UNION()
 * @method Type NULLABLE()
 * @method Type TUPLE()
 * @method Type LIST()
 * @method Type BOOL()
 * @method Type INT()
 * @method Type FLOAT()
 * @method Type STRING()
 * @method Type ARRAY()
 * @method Type OBJECT()
 * @method Type CALLABLE()
 * @method Type ITERABLE()
 * @method Type RESOURCE()
 * @method Type NULL()
 *
 */
final class Type extends Enum
{
    private const UNION = 'union';
    private const NULLABLE = 'nullable';
    private const TUPLE = 'tuple';
    private const LIST = 'list';
    private const BOOL = 'bool';
    private const INT = 'int';
    private const FLOAT = 'float';
    private const STRING = 'string';
    private const ARRAY = 'array';
    private const OBJECT = 'object';
    private const CALLABLE = 'callable';
    private const ITERABLE = 'iterable';
    private const RESOURCE = 'resource';
    private const NULL = 'null';
}
