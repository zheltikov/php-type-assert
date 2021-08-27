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
 * @method Type INTERSECTION()
 * @method Type NULLABLE()
 * @method Type TUPLE()
 * @method Type SHAPE()
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
 * @method Type NEGATED()
 * @method Type USER_DEFINED()
 * @method Type ARRAYKEY()
 * @method Type NOT_NULL()
 * @method Type SCALAR()
 * @method Type NUMBER()
 * @method Type MIXED()
 * @method Type VOID()
 * @method Type VEC_OR_DICT()
 * @method Type VEC()
 * @method Type DICT()
 * @method Type KEYSET()
 * @method Type NOT_EMPTY()
 * @method Type EMPTY()
 * @method Type TRUE()
 * @method Type FALSE()
 * @method Type POSITIVE()
 * @method Type NEGATIVE()
 * @method Type RAW_STRING()
 * @method Type KEY_VALUE_PAIR()
 * @method Type OPTIONAL()
 * @method Type ELLIPSIS()
 * @method Type GENERIC_LIST()
 * @method Type RAW_INTEGER()
 *
 */
final class Type extends Enum
{
    private const UNION = 'union';
    private const INTERSECTION = 'intersection';
    private const NULLABLE = 'nullable';
    private const TUPLE = 'tuple';
    private const SHAPE = 'shape';
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
    private const NEGATED = 'negated';
    private const USER_DEFINED = 'user_defined';
    private const ARRAYKEY = 'arraykey';
    private const NOT_NULL = 'not_null';
    private const SCALAR = 'scalar';
    private const NUMBER = 'number';
    private const MIXED = 'mixed';
    private const VOID = 'void';
    private const VEC_OR_DICT = 'vec_or_dict';
    private const VEC = 'vec';
    private const DICT = 'dict';
    private const KEYSET = 'keyset';
    private const NOT_EMPTY = 'not_empty';
    private const EMPTY = 'empty';
    private const TRUE = 'true';
    private const FALSE = 'false';
    private const POSITIVE = 'positive';
    private const NEGATIVE = 'negative';
    private const RAW_STRING = 'raw_string';
    private const KEY_VALUE_PAIR = 'key_value_pair';
    private const OPTIONAL = 'optional';
    private const ELLIPSIS = 'ellipsis';
    private const GENERIC_LIST = 'generic_list';
    private const RAW_INTEGER = 'raw_integer';
}
