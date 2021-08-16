<?php

/* @generated */

namespace Zheltikov\TypeAssert\Parser;

/* This is an automatically GENERATED file, which should not be manually edited.
 * Instead edit one of the following:
 *  * the grammar files parser/types.y
 *  * the skeleton file parser/parser.template
 *  * the preprocessing script parser/rebuild_parser.php
 */
class Types extends ParserAbstract
{
    /** @var Node|null */
    protected $semValue;

    protected $tokenToSymbolMapSize = 312;
    protected $actionTableSize = 47;
    protected $gotoTableSize = 9;

    protected $invalidSymbol = 57;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE = 10;
    protected $numNonLeafStates = 23;

    protected $symbolToName = [
        "EOF",
        "error",
        "TYPE_BOOL",
        "TYPE_INT",
        "TYPE_FLOAT",
        "TYPE_STRING",
        "TYPE_ARRAY",
        "TYPE_OBJECT",
        "TYPE_CALLABLE",
        "TYPE_ITERABLE",
        "TYPE_RESOURCE",
        "TYPE_NULL",
        "TYPE_NOT_NULL",
        "TYPE_SCALAR",
        "TYPE_NUMBER",
        "TYPE_MIXED",
        "TYPE_VOID",
        "TYPE_ARRAYKEY",
        "TYPE_SHAPE",
        "TYPE_TUPLE",
        "TYPE_VEC",
        "TYPE_DICT",
        "TYPE_KEYSET",
        "TYPE_VEC_OR_DICT",
        "TYPE_EMPTY",
        "TYPE_NOT_EMPTY",
        "TYPE_TRUE",
        "TYPE_FALSE",
        "TYPE_POSITIVE",
        "TYPE_NEGATIVE",
        "TYPE_USER_DEFINED",
        "TOKEN_NS_SEPARATOR",
        "PREFIX_NULLABLE",
        "PREFIX_NEGATED",
        "PAREN_LEFT",
        "PAREN_RIGHT",
        "TOKEN_COMMA",
        "TOKEN_UNION",
        "TOKEN_INTERSECTION",
        "TOKEN_STRING_DQ",
        "TOKEN_STRING_SQ",
        "TOKEN_EOF",
        "TYPE_COUNTABLE",
        "TYPE_NUMERIC",
        "TYPE_CLASSNAME",
        "TYPE_INTERFACENAME",
        "TYPE_TRAITNAME",
        "TYPE_CHAR",
        "TYPE_STRINGISH",
        "TYPE_NOT_POSITIVE",
        "TYPE_NOT_NEGATIVE",
        "TYPE_PLACEHOLDER",
        "TOKEN_ARROW",
        "GENERIC_LIST_START",
        "GENERIC_LIST_END",
        "TOKEN_WHITESPACE",
        "TOKEN_ERROR"
    ];

    protected $tokenToSymbol = [
            0,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,   57,   57,   57,   57,
           57,   57,   57,   57,   57,   57,    1,   41,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   12,   42,
           43,   13,   14,   15,   16,   17,   44,   45,   46,   18,
           19,   20,   21,   22,   23,   24,   25,   47,   48,   26,
           27,   28,   49,   29,   50,   30,   51,   31,   32,   33,
           34,   35,   36,   52,   53,   54,   37,   38,   55,   56,
           39,   40
    ];

    protected $action = [
           64,   65,   66,   67,   68,   69,   70,   71,   72,   73,
           42,   43,   44,   45,   46,   41,   17,   18,   48,   49,
           50,   47,   52,   51,   53,   54,   55,   56,    6,    7,
            3,    4,    5,   19,   10,    0,   11,   60,   61,   58,
            1,   21,    0,   31,   57,    0,    2
    ];

    protected $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,   15,   16,   17,   18,   19,   20,   21,
           22,   23,   24,   25,   26,   27,   28,   29,   37,   38,
           32,   33,   34,   30,   31,    0,   31,   39,   40,   35,
           34,   34,   -1,   35,   35,   -1,   36
    ];

    protected $actionBase = [
           -2,   -2,   -2,   -2,   -2,   -2,   -2,   -2,    8,   10,
            3,    3,   -9,   -9,   -9,   -9,   -9,    7,    6,    5,
           35,    4,    9,    3,    3,    3,    3,    3,    3,    3,
            3,   -9,   -9
    ];

    protected $actionDefault = [
        32767,32767,32767,32767,32767,32767,32767,32767,32767,   40,
        32767,32767,    1,    7,   11,    2,    3,32767,32767,   17,
        32767,32767,32767
    ];

    protected $goto = [
           62,   12,   39,   38,   13,   14,    8,   15,   16
    ];

    protected $gotoCheck = [
           11,    2,    9,    9,    2,    2,    2,    2,    2
    ];

    protected $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,    0,   -8,
            0,   -2,    0
    ];

    protected $gotoDefault = [
        -32768,   20,    9,   27,   28,   29,   32,   33,   35,   36,
           37,   22,-32768
    ];

    protected $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    2,    2,    2,    9,    9,    9,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    6,    7,   12,   10,   10,   11,
           11,    3,    3,    3,    3,    4,    4,    4,    4,    5,
            5
    ];

    protected $ruleToLength = [
            1,    1,    3,    3,    1,    1,    1,    2,    3,    1,
            1,    2,    1,    1,    1,    3,    2,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    4,    3,    3,    1,    1,    3,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1
    ];

    protected $productions = [
        "\$start : root",
        "root : type",
        "type : type TOKEN_UNION type",
        "type : type TOKEN_INTERSECTION type",
        "type : scalar_type",
        "type : compound_type",
        "type : special_type",
        "type : PREFIX_NULLABLE type",
        "type : PAREN_LEFT type PAREN_RIGHT",
        "type : tuple",
        "type : shape",
        "type : PREFIX_NEGATED type",
        "type : custom_type",
        "type : user_defined_type",
        "type : raw_string",
        "user_defined_type : TYPE_USER_DEFINED TOKEN_NS_SEPARATOR user_defined_type",
        "user_defined_type : TOKEN_NS_SEPARATOR user_defined_type",
        "user_defined_type : TYPE_USER_DEFINED",
        "custom_type : TYPE_ARRAYKEY",
        "custom_type : TYPE_NOT_NULL",
        "custom_type : TYPE_SCALAR",
        "custom_type : TYPE_NUMBER",
        "custom_type : TYPE_MIXED",
        "custom_type : TYPE_VOID",
        "custom_type : TYPE_VEC_OR_DICT",
        "custom_type : TYPE_VEC",
        "custom_type : TYPE_DICT",
        "custom_type : TYPE_KEYSET",
        "custom_type : TYPE_NOT_EMPTY",
        "custom_type : TYPE_EMPTY",
        "custom_type : TYPE_TRUE",
        "custom_type : TYPE_FALSE",
        "custom_type : TYPE_POSITIVE",
        "custom_type : TYPE_NEGATIVE",
        "tuple : TYPE_TUPLE PAREN_LEFT type_comma_list PAREN_RIGHT",
        "shape : TYPE_SHAPE PAREN_LEFT PAREN_RIGHT",
        "key_value_pair : raw_string TOKEN_ARROW type",
        "raw_string : TOKEN_STRING_DQ",
        "raw_string : TOKEN_STRING_SQ",
        "type_comma_list : type TOKEN_COMMA type_comma_list",
        "type_comma_list : type",
        "scalar_type : TYPE_BOOL",
        "scalar_type : TYPE_INT",
        "scalar_type : TYPE_FLOAT",
        "scalar_type : TYPE_STRING",
        "compound_type : TYPE_ARRAY",
        "compound_type : TYPE_OBJECT",
        "compound_type : TYPE_CALLABLE",
        "compound_type : TYPE_ITERABLE",
        "special_type : TYPE_RESOURCE",
        "special_type : TYPE_NULL"
    ];

    protected function initReduceCallbacks()
    {
        $this->reduceCallbacks = [
            0 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            1 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            2 => function ($stackPos) {
                 $this->semValue = new Node(Type::UNION());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-1)])->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            3 => function ($stackPos) {
                 $this->semValue = new Node(Type::INTERSECTION());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-1)])->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            4 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            5 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            6 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            7 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULLABLE());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            8 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-2)];
            },
            9 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            10 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            11 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATED());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            12 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            13 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            14 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            15 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            16 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue('\\' . $this->semValue->getValue());
            },
            17 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            18 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAYKEY());
            },
            19 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_NULL());
            },
            20 => function ($stackPos) {
                 $this->semValue = new Node(Type::SCALAR());
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::NUMBER());
            },
            22 => function ($stackPos) {
                 $this->semValue = new Node(Type::MIXED());
            },
            23 => function ($stackPos) {
                 $this->semValue = new Node(Type::VOID());
            },
            24 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC_OR_DICT());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC());
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::DICT());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEYSET());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_EMPTY());
            },
            29 => function ($stackPos) {
                 $this->semValue = new Node(Type::EMPTY());
            },
            30 => function ($stackPos) {
                 $this->semValue = new Node(Type::TRUE());
            },
            31 => function ($stackPos) {
                 $this->semValue = new Node(Type::FALSE());
            },
            32 => function ($stackPos) {
                 $this->semValue = new Node(Type::POSITIVE());
            },
            33 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATIVE());
            },
            34 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            35 => function ($stackPos) {
                 $this->semValue = new Node(Type::SHAPE());
            },
            36 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR(), $this->semStack[$stackPos-(3-1)]);
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            37 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            38 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            39 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            40 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            41 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            42 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            43 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            44 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            45 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            46 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            47 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            48 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            49 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            50 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
        ];
    }
}
