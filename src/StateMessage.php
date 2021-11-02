<?php

namespace Zheltikov\TypeAssert;

use MyCLabs\Enum\Enum;

/**
 * Class StateMessage
 * @package Zheltikov\TypeAssert
 *
 * @extends Enum<StateMessage>
 *
 * @method static StateMessage UNION_MISMATCH()
 * @method static StateMessage INTERSECTION_MISMATCH()
 * @method static StateMessage NOT_ARRAY()
 * @method static StateMessage TUPLE_WRONG_LENGTH()
 * @method static StateMessage TUPLE_INVALID_KEY()
 * @method static StateMessage TUPLE_INVALID_CHILD()
 * @method static StateMessage SHAPE_WRONG_LENGTH()
 * @method static StateMessage OPEN_SHAPE_WRONG_LENGTH()
 * @method static StateMessage SHAPE_REQUIRED_KEY()
 * @method static StateMessage SHAPE_WRONG_VALUE()
 * @method static StateMessage OPTIONAL_SHAPE_WRONG_LENGTH()
 * @method static StateMessage OPEN_OPTIONAL_SHAPE_WRONG_LENGTH()
 * @method static StateMessage SHAPE_INVALID_KEY()
 * @method static StateMessage EXPECTED_BOOL()
 * @method static StateMessage EXPECTED_INT()
 * @method static StateMessage EXPECTED_FLOAT()
 * @method static StateMessage EXPECTED_STRING()
 * @method static StateMessage EXPECTED_ARRAY()
 * @method static StateMessage EXPECTED_OBJECT()
 * @method static StateMessage ARRAY_INVALID_INDEX_CHILD()
 * @method static StateMessage ARRAY_INVALID_KEY_CHILD()
 * @method static StateMessage ARRAY_INVALID_KEY()
 * @method static StateMessage EXPECTED_CALLABLE()
 * @method static StateMessage EXPECTED_ITERABLE()
 * @method static StateMessage EXPECTED_RESOURCE()
 * @method static StateMessage EXPECTED_NULL()
 * @method static StateMessage EXPECTED_SCALAR()
 * @method static StateMessage NEGATED_MISMATCH()
 * @method static StateMessage NOT_INSTANCEOF()
 * @method static StateMessage NOT_VOID()
 * @method static StateMessage EXPECTED_EMPTY()
 * @method static StateMessage EXPECTED_TRUE()
 * @method static StateMessage EXPECTED_FALSE()
 * @method static StateMessage EXPECTED_POSITIVE()
 * @method static StateMessage EXPECTED_NEGATIVE()
 * @method static StateMessage MATCH_STRING()
 * @method static StateMessage MATCH_INT()
 * @method static StateMessage MATCH_FLOAT()
 * @method static StateMessage MATCH_REGEX()
 * @method static StateMessage MATCH_FORMAT()
 * @method static StateMessage EXPECTED_MATCH_PLACEHOLDER()
 * @method static StateMessage NON_MATCHING_PLACEHOLDERS()
 * @method static StateMessage NOT_NUMERIC()
 * @method static StateMessage NOT_INTABLE()
 *
 */
final class StateMessage extends Enum
{
    private const UNION_MISMATCH = 'union_mismatch';
    private const INTERSECTION_MISMATCH = 'intersection_mismatch';
    private const NOT_ARRAY = 'not_array';
    private const TUPLE_WRONG_LENGTH = 'tuple_wrong_length';
    private const TUPLE_INVALID_KEY = 'tuple_invalid_key';
    private const TUPLE_INVALID_CHILD = 'tuple_invalid_child';
    private const SHAPE_WRONG_LENGTH = 'shape_wrong_length';
    private const OPEN_SHAPE_WRONG_LENGTH = 'open_shape_wrong_length';
    private const SHAPE_REQUIRED_KEY = 'shape_required_key';
    private const SHAPE_WRONG_VALUE = 'shape_wrong_value';
    private const OPTIONAL_SHAPE_WRONG_LENGTH = 'optional_shape_wrong_length';
    private const OPEN_OPTIONAL_SHAPE_WRONG_LENGTH = 'open_optional_shape_wrong_length';
    private const SHAPE_INVALID_KEY = 'shape_invalid_key';
    private const EXPECTED_BOOL = 'expected_bool';
    private const EXPECTED_INT = 'expected_int';
    private const EXPECTED_FLOAT = 'expected_float';
    private const EXPECTED_STRING = 'expected_string';
    private const EXPECTED_ARRAY = 'expected_array';
    private const EXPECTED_OBJECT = 'expected_object';
    private const ARRAY_INVALID_INDEX_CHILD = 'array_invalid_index_child';
    private const ARRAY_INVALID_KEY_CHILD = 'array_invalid_key_child';
    private const ARRAY_INVALID_KEY = 'array_invalid_key';
    private const EXPECTED_CALLABLE = 'expected_callable';
    private const EXPECTED_ITERABLE = 'expected_iterable';
    private const EXPECTED_RESOURCE = 'expected_resource';
    private const EXPECTED_NULL = 'expected_null';
    private const EXPECTED_SCALAR = 'expected_scalar';
    private const NEGATED_MISMATCH = 'negated_mismatch';
    private const NOT_INSTANCEOF = 'not_instanceof';
    private const NOT_VOID = 'not_void';
    private const EXPECTED_EMPTY = 'expected_empty';
    private const EXPECTED_TRUE = 'expected_true';
    private const EXPECTED_FALSE = 'expected_false';
    private const EXPECTED_POSITIVE = 'expected_positive';
    private const EXPECTED_NEGATIVE = 'expected_negative';
    private const MATCH_STRING = 'match_string';
    private const MATCH_INT = 'match_int';
    private const MATCH_FLOAT = 'match_float';
    private const MATCH_REGEX = 'match_regex';
    private const MATCH_FORMAT = 'match_format';
    private const EXPECTED_MATCH_PLACEHOLDER = 'expected_match_placeholder';
    private const NON_MATCHING_PLACEHOLDERS = 'non_matching_placeholders';
    private const NOT_NUMERIC = 'not_numeric';
    private const NOT_INTABLE = 'not_intable';
}
