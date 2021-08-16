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

    protected $tokenToSymbolMapSize = 310;
    protected $actionTableSize = 43;
    protected $gotoTableSize = 9;

    protected $invalidSymbol = 55;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE = 10;
    protected $numNonLeafStates = 21;

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
        "TOKEN_EOF",
        "TYPE_COUNTABLE",
        "TYPE_NUMERIC",
        "TYPE_CLASSNAME",
        "TYPE_INTERFACENAME",
        "TYPE_TRAITNAME",
        "TYPE_SHAPE",
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
            0,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,   55,   55,   55,   55,
           55,   55,   55,   55,   55,   55,    1,   38,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   12,   39,
           40,   13,   14,   15,   16,   17,   41,   42,   43,   44,
           18,   19,   20,   21,   22,   23,   24,   45,   46,   25,
           26,   27,   47,   28,   48,   29,   49,   30,   31,   32,
           33,   34,   35,   50,   51,   52,   36,   37,   53,   54
    ];

    protected $action = [
           56,   57,   58,   59,   60,   61,   62,   63,   64,   65,
           38,   39,   40,   41,   42,   37,   17,   44,   45,   46,
           43,   48,   47,   49,   50,   51,   52,    6,    7,    3,
            4,    5,   18,   10,    0,   11,   29,    1,    0,    0,
           53,    0,    2
    ];

    protected $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,   15,   16,   17,   18,   19,   20,   21,
           22,   23,   24,   25,   26,   27,   28,   36,   37,   31,
           32,   33,   29,   30,    0,   30,   34,   33,   -1,   -1,
           34,   -1,   35
    ];

    protected $actionBase = [
           -2,   -2,   -2,   -2,   -2,   -2,   -2,   -2,    2,    7,
            3,    3,   -9,   -9,   -9,   -9,   -9,    4,    5,   34,
            6,    3,    3,    3,    3,    3,    3,    3,    3,   -9,
           -9
    ];

    protected $actionDefault = [
        32767,32767,32767,32767,32767,32767,32767,32767,32767,   34,
        32767,32767,    1,    7,   10,    2,    3,32767,   15,32767,
        32767
    ];

    protected $goto = [
           54,   12,   35,   34,   13,   14,    8,   15,   16
    ];

    protected $gotoCheck = [
            9,    2,    8,    8,    2,    2,    2,    2,    2
    ];

    protected $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,   -8,   -2
    ];

    protected $gotoDefault = [
        -32768,   19,    9,   25,   26,   27,   30,   32,   33,   20
    ];

    protected $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    2,    8,    8,    8,    7,    7,    7,    7,
            7,    7,    7,    7,    7,    7,    7,    7,    7,    7,
            7,    7,    6,    9,    9,    3,    3,    3,    3,    4,
            4,    4,    4,    5,    5
    ];

    protected $ruleToLength = [
            1,    1,    3,    3,    1,    1,    1,    2,    3,    1,
            2,    1,    1,    3,    2,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    4,    3,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1
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
        "type : PREFIX_NEGATED type",
        "type : custom_type",
        "type : user_defined_type",
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
                 $this->semValue = new Node(Type::NEGATED());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            11 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            12 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            13 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            14 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue('\\' . $this->semValue->getValue());
            },
            15 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            16 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAYKEY());
            },
            17 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_NULL());
            },
            18 => function ($stackPos) {
                 $this->semValue = new Node(Type::SCALAR());
            },
            19 => function ($stackPos) {
                 $this->semValue = new Node(Type::NUMBER());
            },
            20 => function ($stackPos) {
                 $this->semValue = new Node(Type::MIXED());
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::VOID());
            },
            22 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC_OR_DICT());
            },
            23 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC());
            },
            24 => function ($stackPos) {
                 $this->semValue = new Node(Type::DICT());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEYSET());
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_EMPTY());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::EMPTY());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::TRUE());
            },
            29 => function ($stackPos) {
                 $this->semValue = new Node(Type::FALSE());
            },
            30 => function ($stackPos) {
                 $this->semValue = new Node(Type::POSITIVE());
            },
            31 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATIVE());
            },
            32 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            33 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            34 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            35 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            36 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            37 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            38 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            39 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            40 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            41 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            42 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            43 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            44 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
        ];
    }
}
