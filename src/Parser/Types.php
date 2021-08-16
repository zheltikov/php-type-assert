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
    protected $actionTableSize = 27;
    protected $gotoTableSize = 8;

    protected $invalidSymbol = 55;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE = 11;
    protected $numNonLeafStates = 19;

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
        "TYPE_TUPLE",
        "TYPE_USER_DEFINED",
        "TOKEN_NS_SEPARATOR",
        "PREFIX_NULLABLE",
        "PREFIX_NEGATED",
        "PAREN_LEFT",
        "PAREN_RIGHT",
        "TOKEN_COMMA",
        "TOKEN_UNION",
        "TOKEN_EOF",
        "TYPE_NOT_NULL",
        "TYPE_COUNTABLE",
        "TYPE_NUMERIC",
        "TYPE_SCALAR",
        "TYPE_NUMBER",
        "TYPE_MIXED",
        "TYPE_VOID",
        "TYPE_ARRAYKEY",
        "TYPE_CLASSNAME",
        "TYPE_INTERFACENAME",
        "TYPE_TRAITNAME",
        "TYPE_SHAPE",
        "TYPE_VEC",
        "TYPE_DICT",
        "TYPE_KEYSET",
        "TYPE_VEC_OR_DICT",
        "TYPE_EMPTY",
        "TYPE_NOT_EMPTY",
        "TYPE_CHAR",
        "TYPE_STRINGISH",
        "TYPE_TRUE",
        "TYPE_FALSE",
        "TYPE_POSITIVE",
        "TYPE_NOT_POSITIVE",
        "TYPE_NEGATIVE",
        "TYPE_NOT_NEGATIVE",
        "TYPE_PLACEHOLDER",
        "TOKEN_ARROW",
        "GENERIC_LIST_START",
        "GENERIC_LIST_END",
        "TOKEN_INTERSECTION",
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
           55,   55,   55,   55,   55,   55,    1,   21,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   22,   23,
           24,   25,   26,   27,   28,   29,   30,   31,   32,   33,
           12,   34,   35,   36,   37,   38,   39,   40,   41,   42,
           43,   44,   45,   46,   47,   13,   48,   14,   15,   16,
           17,   18,   19,   49,   50,   51,   20,   52,   53,   54
    ];

    protected $action = [
           38,   39,   40,   41,   42,   43,   44,   45,   46,   47,
           11,    0,    1,    3,    4,    5,   12,    7,    8,   26,
           35,    0,    0,    0,    2,    0,    6
    ];

    protected $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,    0,   17,   15,   16,   17,   13,   14,   14,   18,
           18,   -1,   -1,   -1,   19,   -1,   20
    ];

    protected $actionBase = [
           -2,   -2,   -2,   -2,   -2,   -2,   -2,    3,    3,    1,
            5,   -5,    4,   11,    6,    6,    6,    2,    6,    3,
            3,    3,    3,    3,    3,    3,    0,    0,    6,    6
    ];

    protected $actionDefault = [
           15,   15,   15,   15,   15,   15,   15,32767,32767,32767,
           18,32767,   14,32767,    1,    6,    9,32767,    2
    ];

    protected $goto = [
           36,   14,   32,   31,   15,   16,    9,   18
    ];

    protected $gotoCheck = [
            9,    2,    8,    8,    2,    2,    2,    2
    ];

    protected $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,   -5,   -2
    ];

    protected $gotoDefault = [
        -32768,   13,   10,   22,   23,   24,   27,   29,   30,   17
    ];

    protected $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    8,    8,    8,    7,    6,    9,    9,    3,
            3,    3,    3,    4,    4,    4,    4,    5,    5
    ];

    protected $ruleToLength = [
            1,    1,    3,    1,    1,    1,    2,    3,    1,    2,
            1,    1,    3,    2,    1,    0,    4,    3,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1
    ];

    protected $productions = [
        "\$start : root",
        "root : type",
        "type : type TOKEN_UNION type",
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
        "custom_type : /* empty */",
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
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            4 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            5 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            6 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULLABLE());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            7 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-2)];
            },
            8 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            9 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATED());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            10 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            11 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            12 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            13 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue($this->semStack[$stackPos-(2-1)] . '\\' . $this->semValue->getValue());
            },
            14 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            15 => function ($stackPos) {
                $this->semValue = $this->semStack[$stackPos];
            },
            16 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            17 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            18 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            19 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            20 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            22 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            23 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            24 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
        ];
    }
}
