<?php

/* @generated */

namespace Zheltikov\TypeAssert\Parser;

use MyCLabs\Enum\Enum;

/* GENERATED file based on parser/tokens.y */
final class Tokens extends Enum
{
    private const YYERRTOK = 256;
    private const TOKEN_EOF = 257;
    private const TYPE_BOOL = 258;
    private const TYPE_INT = 259;
    private const TYPE_FLOAT = 260;
    private const TYPE_STRING = 261;
    private const TYPE_ARRAY = 262;
    private const TYPE_OBJECT = 263;
    private const TYPE_CALLABLE = 264;
    private const TYPE_ITERABLE = 265;
    private const TYPE_RESOURCE = 266;
    private const TYPE_NULL = 267;
    private const TYPE_NOT_NULL = 268;
    private const TYPE_COUNTABLE = 269;
    private const TYPE_NUMERIC = 270;
    private const TYPE_SCALAR = 271;
    private const TYPE_NUMBER = 272;
    private const TYPE_MIXED = 273;
    private const TYPE_VOID = 274;
    private const TYPE_ARRAYKEY = 275;
    private const TYPE_CLASSNAME = 276;
    private const TYPE_INTERFACENAME = 277;
    private const TYPE_TRAITNAME = 278;
    private const TYPE_SHAPE = 279;
    private const TYPE_TUPLE = 280;
    private const TYPE_VEC = 281;
    private const TYPE_DICT = 282;
    private const TYPE_KEYSET = 283;
    private const TYPE_VEC_OR_DICT = 284;
    private const TYPE_EMPTY = 285;
    private const TYPE_NOT_EMPTY = 286;
    private const TYPE_CHAR = 287;
    private const TYPE_STRINGISH = 288;
    private const TYPE_TRUE = 289;
    private const TYPE_FALSE = 290;
    private const TYPE_POSITIVE = 291;
    private const TYPE_NOT_POSITIVE = 292;
    private const TYPE_NEGATIVE = 293;
    private const TYPE_NOT_NEGATIVE = 294;
    private const TYPE_USER_DEFINED = 295;
    private const TYPE_PLACEHOLDER = 296;
    private const TOKEN_NS_SEPARATOR = 297;
    private const PREFIX_NULLABLE = 298;
    private const PREFIX_NEGATED = 299;
    private const PAREN_LEFT = 300;
    private const PAREN_RIGHT = 301;
    private const TOKEN_COMMA = 302;
    private const TOKEN_ARROW = 303;
    private const TOKEN_UNION = 304;
    private const TOKEN_INTERSECTION = 305;
    private const TOKEN_WHITESPACE = 306;
    private const TOKEN_ERROR = 307;
    private const TOKEN_STRING_DQ = 308;
    private const TOKEN_STRING_SQ = 309;
    private const TOKEN_ELLIPSIS = 310;
    private const TOKEN_ANGLE_LEFT = 311;
    private const TOKEN_ANGLE_RIGHT = 312;
}
