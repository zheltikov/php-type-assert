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

    protected int $tokenToSymbolMapSize = 317;
    protected int $actionTableSize = 67;
    protected int $gotoTableSize = 20;

    protected int $invalidSymbol = 62;
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
        "TOKEN_RAW_FLOAT",
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
            0,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,   62,   62,   62,   62,
           62,   62,   62,   62,   62,   62,    1,   47,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   12,   48,
           49,   13,   14,   15,   16,   17,   50,   51,   52,   18,
           19,   20,   21,   22,   23,   24,   25,   53,   54,   26,
           27,   28,   55,   29,   56,   30,   57,   31,   32,   33,
           34,   35,   36,   37,   38,   39,   58,   59,   40,   41,
           42,   43,   44,   60,   61,   45,   46
    ];

    protected array $action = [
           87,   88,   89,   90,   21,   92,   93,   94,   95,   96,
           55,   56,   57,   58,   59,   54,   22,   23,   61,   62,
           63,   60,   65,   64,   66,   67,   68,   69,   24,   15,
            4,    5,    6,    7,    8,   17,   24,   15,   77,   78,
            0,   77,   78,   79,   80,   76,   16,    2,   11,    9,
            1,   40,   71,   70,   97,    3,   12,    0,   10,    0,
            0,    0,    0,    0,    0,    0,   98
    ];

    protected array $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,   15,   16,   17,   18,   19,   20,   21,
           22,   23,   24,   25,   26,   27,   28,   29,   30,   31,
           32,   33,   34,   38,   39,   32,   30,   31,   40,   41,
            0,   40,   41,   45,   46,   42,   31,   34,   34,   37,
           43,   35,   35,   35,   44,   36,   36,   -1,   37,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   44
    ];

    protected array $actionBase = [
           -2,   22,   -2,   -2,   -2,   -2,   -2,   -2,   -2,   -2,
           -2,    3,    3,   16,   19,    6,    6,    1,   -5,   -5,
           -5,    7,   14,   13,   15,   40,   10,   12,   17,   20,
           18,   21,    0,   -2,    0,    0,    0,    0,    0,    0,
            0,    0,    0,    1,    1,   -5,   -5
    ];

    protected array $actionDefault = [
        32767,32767,32767,   54,32767,32767,32767,32767,32767,32767,
        32767,32767,   51,32767,   53,32767,32767,32767,    1,   40,
           41,   59,32767,32767,   21,32767,32767,32767,32767,   50,
        32767,32767
    ];

    protected array $goto = [
           81,   18,   52,   51,    0,   39,   43,   13,   34,   35,
           19,   20,    0,   27,   27,   30,   84,    0,    0,   31
    ];

    protected array $gotoCheck = [
           16,    2,    9,    9,   -1,    2,    2,    2,    2,    2,
            2,    2,   -1,   10,   10,   15,   15,   -1,   -1,   10
    ];

    protected array $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,    0,  -13,
            2,    0,    0,    0,    0,   13,  -12,    0,    0,    0
    ];

    protected array $gotoDefault = [
        -32768,   25,   14,   36,   37,   38,   41,   42,   44,   45,
           46,   47,   48,   49,   50,   26,   28,   74,   75,   29
    ];

    protected array $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    2,    2,    2,    2,    2,    2,   13,    9,
            9,    9,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,    6,    7,
           17,   18,   19,   19,   19,   10,   10,   11,   12,   16,
           16,   16,   15,   15,   15,    3,    3,    3,    3,    4,
            4,    4,    4,    5,    5,   14,   14
    ];

    protected array $ruleToLength = [
            1,    1,    3,    3,    1,    1,    1,    2,    3,    1,
            1,    2,    1,    1,    1,    1,    1,    1,    2,    3,
            2,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    4,    4,
            3,    4,    1,    1,    1,    1,    1,    1,    1,    3,
            1,    2,    3,    1,    2,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1,    3,    2
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
        "type : raw_float",
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
        "raw_float : TOKEN_RAW_FLOAT",
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
                                        if ($this->semStack[$stackPos-(3-1)]->getType()->equals(Type::UNION())) {
                                            $this->semValue->appendChildren($this->semStack[$stackPos-(3-1)]->getChildren());
                                        } else {
                                            $this->semValue->appendChild($this->semStack[$stackPos-(3-1)]);
                                        }
                                        if ($this->semStack[$stackPos-(3-3)]->getType()->equals(Type::UNION())) {
                                            $this->semValue->appendChildren($this->semStack[$stackPos-(3-3)]->getChildren());
                                        } else {
                                            $this->semValue->appendChild($this->semStack[$stackPos-(3-3)]);
                                        }

            },
            3 => function ($stackPos) {

                                        $this->semValue = new Node(Type::INTERSECTION());
                                        if ($this->semStack[$stackPos-(3-1)]->getType()->equals(Type::INTERSECTION())) {
                                            $this->semValue->appendChildren($this->semStack[$stackPos-(3-1)]->getChildren());
                                        } else {
                                            $this->semValue->appendChild($this->semStack[$stackPos-(3-1)]);
                                        }
                                        if ($this->semStack[$stackPos-(3-3)]->getType()->equals(Type::INTERSECTION())) {
                                            $this->semValue->appendChildren($this->semStack[$stackPos-(3-3)]->getChildren());
                                        } else {
                                            $this->semValue->appendChild($this->semStack[$stackPos-(3-3)]);
                                        }

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
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            18 => function ($stackPos) {
                 $this->semValue = $this->semValue = new Node(Type::ARRAY());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            19 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            20 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue('\\' . $this->semValue->getValue());
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            22 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAYKEY());
            },
            23 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_NULL());
            },
            24 => function ($stackPos) {
                 $this->semValue = new Node(Type::SCALAR());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::NUMBER());
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::MIXED());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::VOID());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC_OR_DICT());
            },
            29 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC());
            },
            30 => function ($stackPos) {
                 $this->semValue = new Node(Type::DICT());
            },
            31 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEYSET());
            },
            32 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_EMPTY());
            },
            33 => function ($stackPos) {
                 $this->semValue = new Node(Type::EMPTY());
            },
            34 => function ($stackPos) {
                 $this->semValue = new Node(Type::TRUE());
            },
            35 => function ($stackPos) {
                 $this->semValue = new Node(Type::FALSE());
            },
            36 => function ($stackPos) {
                 $this->semValue = new Node(Type::POSITIVE());
            },
            37 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATIVE());
            },
            38 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            39 => function ($stackPos) {
                 $this->semValue = new Node(Type::SHAPE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            40 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-1)])->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            41 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild(
                                            (new Node(Type::OPTIONAL()))
                                                ->appendChild($this->semStack[$stackPos-(4-2)])
                                        )->appendChild($this->semStack[$stackPos-(4-4)]);
            },
            42 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            43 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            44 => function ($stackPos) {
                 $this->semValue = new Node(Type::ELLIPSIS());
            },
            45 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            46 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            47 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_INTEGER());
                                        $this->semValue->setValue(intval($this->semStack[$stackPos-(1-1)]));
            },
            48 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_FLOAT());
                                        $this->semValue->setValue(floatval($this->semStack[$stackPos-(1-1)]));
            },
            49 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                                          $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            50 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            51 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            52 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            53 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            54 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            55 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            56 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            57 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            58 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            59 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            60 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            61 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            62 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            63 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            64 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
            65 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(3-2)]->getChildren());
            },
            66 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
            },
        ];
    }
}
