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

    protected $tokenToSymbolMapSize = 308;
    protected $actionTableSize = 22;
    protected $gotoTableSize = 7;

    protected $invalidSymbol = 53;
    protected $errorSymbol = 1;
    protected $defaultAction = -32766;
    protected $unexpectedTokenRule = 32767;

    protected $YY2TBLSTATE = 8;
    protected $numNonLeafStates = 14;

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
        "PREFIX_NULLABLE",
        "PAREN_LEFT",
        "PAREN_RIGHT",
        "TOKEN_COMMA",
        "TOKEN_UNION",
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
        "TYPE_USER_DEFINED",
        "TYPE_PLACEHOLDER",
        "PREFIX_NEGATED",
        "TOKEN_ARROW",
        "GENERIC_LIST_START",
        "GENERIC_LIST_END",
        "TOKEN_INTERSECTION",
        "TOKEN_WHITESPACE",
        "TOKEN_ERROR"
    ];

    protected $tokenToSymbol = [
            0,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,   53,   53,   53,   53,
           53,   53,   53,   53,   53,   53,    1,    2,    3,    4,
            5,    6,    7,    8,    9,   10,   11,   18,   19,   20,
           21,   22,   23,   24,   25,   26,   27,   28,   29,   12,
           30,   31,   32,   33,   34,   35,   36,   37,   38,   39,
           40,   41,   42,   43,   44,   45,   13,   46,   14,   15,
           16,   47,   48,   49,   17,   50,   51,   52
    ];

    protected $action = [
           26,   27,   28,   29,   30,   31,   32,   33,   34,   35,
            8,    3,    4,    0,   21,    1,    0,   23,    0,    2,
            0,    5
    ];

    protected $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,    0,   15,   14,   -1,   15,   -1,   16,
           -1,   17
    ];

    protected $actionBase = [
           -2,   -2,   -2,   -2,   -2,   -2,   -1,    3,    1,   13,
            4,    4,    2,    4,    0,    0,    0,    0,    0,    0,
            4,    4
    ];

    protected $actionDefault = [
        32767,32767,32767,32767,32767,32767,32767,   11,32767,32767,
            1,    6,32767,    2
    ];

    protected $goto = [
           24,   10,    0,    0,   11,    6,   13
    ];

    protected $gotoCheck = [
            7,    2,   -1,   -1,    2,    2,    2
    ];

    protected $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,   -2
    ];

    protected $gotoDefault = [
        -32768,    9,    7,   17,   18,   19,   22,   12
    ];

    protected $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    6,
            7,    7,    3,    3,    3,    3,    4,    4,    4,    4,
            5,    5
    ];

    protected $ruleToLength = [
            1,    1,    3,    1,    1,    1,    2,    3,    1,    4,
            3,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1
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
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            10 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            11 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            12 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            13 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            14 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            15 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            16 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            17 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            18 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            19 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            20 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
        ];
    }
}
