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
    protected ?Node $semValue;

    protected int $tokenToSymbolMapSize = 316;
    protected int $actionTableSize = 66;
    protected int $gotoTableSize = 20;

    protected int $invalidSymbol = 61;
    protected int $errorSymbol = 1;
    protected int $defaultAction = -32766;
    protected int $unexpectedTokenRule = 32767;

    protected int $YY2TBLSTATE = 15;
    protected int $numNonLeafStates = 32;

    protected array $symbolToName = [
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
        "TOKEN_ARROW",
        "TOKEN_UNION",
        "TOKEN_INTERSECTION",
        "TOKEN_STRING_DQ",
        "TOKEN_STRING_SQ",
        "TOKEN_ELLIPSIS",
        "TOKEN_ANGLE_LEFT",
        "TOKEN_ANGLE_RIGHT",
        "TOKEN_RAW_INTEGER",
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
        "TOKEN_WHITESPACE",
        "TOKEN_ERROR",
        "TOKEN_COMMENT_START",
        "TOKEN_COMMENT_END"
    ];

    protected array $tokenToSymbol = [
            0,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,   61,   61,   61,   61,
           61,   61,   61,   61,   61,   61,    1,   46,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   12,   47,
           48,   13,   14,   15,   16,   17,   49,   50,   51,   18,
           19,   20,   21,   22,   23,   24,   25,   52,   53,   26,
           27,   28,   54,   29,   55,   30,   56,   31,   32,   33,
           34,   35,   36,   37,   38,   39,   57,   58,   40,   41,
           42,   43,   44,   59,   60,   45
    ];

    protected array $action = [
           85,   86,   87,   88,   21,   90,   91,   92,   93,   94,
           54,   55,   56,   57,   58,   53,   22,   23,   60,   61,
           62,   59,   64,   63,   65,   66,   67,   68,   24,   15,
            4,    5,    6,    0,   17,   24,   15,    3,   76,   77,
           16,    7,    8,   78,   75,    2,   76,   77,   11,   12,
           40,   70,   69,    1,    0,    9,   10,    0,    0,    0,
            0,    0,    0,    0,   95,   96
    ];

    protected array $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,   15,   16,   17,   18,   19,   20,   21,
           22,   23,   24,   25,   26,   27,   28,   29,   30,   31,
           32,   33,   34,    0,   32,   30,   31,   36,   40,   41,
           31,   38,   39,   45,   42,   34,   40,   41,   34,   36,
           35,   35,   35,   43,   -1,   37,   37,   -1,   -1,   -1,
           -1,   -1,   -1,   -1,   44,   44
    ];

    protected array $actionBase = [
           -2,   21,   -2,   -2,   -2,   -2,   -2,   -2,   -2,   -2,
           -2,    2,    2,   15,    1,    5,    5,    6,    3,    3,
            3,   10,   14,   11,    9,   33,   20,   18,   16,   13,
           17,   19,    0,   -2,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    6,    6,    3,    3
    ];

    protected array $actionDefault = [
        32767,32767,32767,   52,32767,32767,32767,32767,32767,32767,
        32767,32767,   49,32767,   51,32767,32767,32767,    1,   39,
           40,   57,32767,32767,   20,32767,32767,32767,32767,   48,
        32767,32767
    ];

    protected array $goto = [
           79,   18,   51,   50,    0,   39,   43,   13,   34,   35,
           19,   20,    0,   27,   27,   30,   82,    0,    0,   31
    ];

    protected array $gotoCheck = [
           15,    2,    9,    9,   -1,    2,    2,    2,    2,    2,
            2,    2,   -1,   10,   10,   14,   14,   -1,   -1,   10
    ];

    protected array $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,    0,  -13,
            2,    0,    0,    0,   13,  -12,    0,    0,    0
    ];

    protected array $gotoDefault = [
        -32768,   25,   14,   36,   37,   38,   41,   42,   44,   45,
           46,   47,   48,   49,   26,   28,   73,   74,   29
    ];

    protected array $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    2,    2,    2,    2,    2,   12,    9,    9,
            9,    8,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    6,    7,   16,
           17,   18,   18,   18,   10,   10,   11,   15,   15,   15,
           14,   14,   14,    3,    3,    3,    3,    4,    4,    4,
            4,    5,    5,   13,   13
    ];

    protected array $ruleToLength = [
            1,    1,    3,    3,    1,    1,    1,    2,    3,    1,
            1,    2,    1,    1,    1,    1,    1,    2,    3,    2,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    4,    4,    3,
            4,    1,    1,    1,    1,    1,    1,    3,    1,    2,
            3,    1,    2,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    3,    2
    ];

    protected array $productions = [
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
        "type : raw_integer",
        "type : generic_array",
        "generic_array : TYPE_ARRAY generic_list",
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
        "shape : TYPE_SHAPE PAREN_LEFT key_value_pair_list PAREN_RIGHT",
        "key_value_pair : raw_string TOKEN_ARROW type",
        "optional_key_value_pair : PREFIX_NULLABLE raw_string TOKEN_ARROW type",
        "any_key_value_pair : key_value_pair",
        "any_key_value_pair : optional_key_value_pair",
        "any_key_value_pair : TOKEN_ELLIPSIS",
        "raw_string : TOKEN_STRING_DQ",
        "raw_string : TOKEN_STRING_SQ",
        "raw_integer : TOKEN_RAW_INTEGER",
        "key_value_pair_list : any_key_value_pair TOKEN_COMMA key_value_pair_list",
        "key_value_pair_list : any_key_value_pair",
        "key_value_pair_list : any_key_value_pair TOKEN_COMMA",
        "type_comma_list : type TOKEN_COMMA type_comma_list",
        "type_comma_list : type",
        "type_comma_list : type TOKEN_COMMA",
        "scalar_type : TYPE_BOOL",
        "scalar_type : TYPE_INT",
        "scalar_type : TYPE_FLOAT",
        "scalar_type : TYPE_STRING",
        "compound_type : TYPE_ARRAY",
        "compound_type : TYPE_OBJECT",
        "compound_type : TYPE_CALLABLE",
        "compound_type : TYPE_ITERABLE",
        "special_type : TYPE_RESOURCE",
        "special_type : TYPE_NULL",
        "generic_list : TOKEN_ANGLE_LEFT type_comma_list TOKEN_ANGLE_RIGHT",
        "generic_list : TOKEN_ANGLE_LEFT TOKEN_ANGLE_RIGHT"
    ];

    protected function initReduceCallbacks(): void
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
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            15 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            16 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            17 => function ($stackPos) {
                 $this->semValue = $this->semValue = new Node(Type::ARRAY());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            18 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            19 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue('\\' . $this->semValue->getValue());
            },
            20 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAYKEY());
            },
            22 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_NULL());
            },
            23 => function ($stackPos) {
                 $this->semValue = new Node(Type::SCALAR());
            },
            24 => function ($stackPos) {
                 $this->semValue = new Node(Type::NUMBER());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::MIXED());
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::VOID());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC_OR_DICT());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC());
            },
            29 => function ($stackPos) {
                 $this->semValue = new Node(Type::DICT());
            },
            30 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEYSET());
            },
            31 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_EMPTY());
            },
            32 => function ($stackPos) {
                 $this->semValue = new Node(Type::EMPTY());
            },
            33 => function ($stackPos) {
                 $this->semValue = new Node(Type::TRUE());
            },
            34 => function ($stackPos) {
                 $this->semValue = new Node(Type::FALSE());
            },
            35 => function ($stackPos) {
                 $this->semValue = new Node(Type::POSITIVE());
            },
            36 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATIVE());
            },
            37 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            38 => function ($stackPos) {
                 $this->semValue = new Node(Type::SHAPE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            39 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-1)])->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            40 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild(
                                            (new Node(Type::OPTIONAL()))
                                                ->appendChild($this->semStack[$stackPos-(4-2)])
                                        )->appendChild($this->semStack[$stackPos-(4-4)]);
            },
            41 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            42 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            43 => function ($stackPos) {
                 $this->semValue = new Node(Type::ELLIPSIS());
            },
            44 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            45 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            46 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_INTEGER());
                                        $this->semValue->setValue(intval($this->semStack[$stackPos-(1-1)]));
            },
            47 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                                          $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            48 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            49 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            50 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            51 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            52 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            53 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            54 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            55 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            56 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            57 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            58 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            59 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            60 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            61 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            62 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
            63 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(3-2)]->getChildren());
            },
            64 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
            },
        ];
    }
}
