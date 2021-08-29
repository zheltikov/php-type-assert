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

    protected int $tokenToSymbolMapSize = 318;
    protected int $actionTableSize = 67;
    protected int $gotoTableSize = 21;

    protected int $invalidSymbol = 63;
    protected int $errorSymbol = 1;
    protected int $defaultAction = -32766;
    protected int $unexpectedTokenRule = 32767;

    protected int $YY2TBLSTATE = 15;
    protected int $numNonLeafStates = 33;

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
        "TOKEN_REGEX_STR_PREFIX",
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
            0,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,   63,   63,   63,   63,
           63,   63,   63,   63,   63,   63,    1,   48,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   12,   49,
           50,   13,   14,   15,   16,   17,   51,   52,   53,   18,
           19,   20,   21,   22,   23,   24,   25,   54,   55,   26,
           27,   28,   56,   29,   57,   30,   58,   31,   32,   33,
           34,   35,   36,   37,   38,   39,   59,   60,   40,   41,
           42,   43,   44,   61,   62,   45,   46,   47
    ];

    protected array $action = [
           90,   91,   92,   93,   22,   95,   96,   97,   98,   99,
           58,   59,   60,   61,   62,   57,   23,   24,   64,   65,
           66,   63,   68,   67,   69,   70,   71,   72,   25,   15,
            4,    5,    6,   25,   15,    0,   18,   17,   80,   81,
            7,    8,    2,   82,   83,   16,   79,   80,   81,   11,
            3,   41,   74,   73,    1,   12,  100,    9,   10,    0,
            0,    0,    0,    0,    0,    0,  101
    ];

    protected array $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,   15,   16,   17,   18,   19,   20,   21,
           22,   23,   24,   25,   26,   27,   28,   29,   30,   31,
           32,   33,   34,   30,   31,    0,   32,   31,   40,   41,
           38,   39,   34,   45,   46,   47,   42,   40,   41,   34,
           36,   35,   35,   35,   43,   36,   44,   37,   37,   -1,
           -1,   -1,   -1,   -1,   -1,   -1,   44
    ];

    protected array $actionBase = [
           -2,   22,   -2,   -2,   -2,   -2,   -2,   -2,   -2,   -2,
           -2,    4,    4,   16,   14,    3,    7,    3,    7,    2,
            2,    2,   11,   15,    8,    6,   35,   12,   20,   17,
           19,   18,   21,    0,   -2,    0,    0,    0,    0,    0,
            0,    0,    0,    0,    7,    7,    2,    2
    ];

    protected array $actionDefault = [
        32767,32767,32767,   56,32767,32767,32767,32767,32767,32767,
        32767,32767,   53,32767,   55,32767,32767,32767,32767,    1,
           42,   43,   61,32767,32767,   23,32767,32767,32767,32767,
           52,32767,32767
    ];

    protected array $goto = [
           55,   19,   54,   84,    0,   40,   44,   13,   35,   36,
           20,   21,    0,   28,   28,   31,   87,    0,   52,    0,
           32
    ];

    protected array $gotoCheck = [
            9,    2,    9,   17,   -1,    2,    2,    2,    2,    2,
            2,    2,   -1,   10,   10,   16,   16,   -1,   10,   -1,
           10
    ];

    protected array $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,    0,  -15,
            2,    0,    0,    0,    0,    0,   13,   -9,    0,    0,
            0
    ];

    protected array $gotoDefault = [
        -32768,   26,   14,   37,   38,   39,   42,   43,   45,   46,
           47,   48,   49,   50,   51,   53,   27,   29,   77,   78,
           30
    ];

    protected array $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    2,    2,    2,    2,    2,    2,    2,   14,
           13,    9,    9,    9,    8,    8,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,    8,    8,
            6,    7,   18,   19,   20,   20,   20,   10,   10,   11,
           12,   17,   17,   17,   16,   16,   16,    3,    3,    3,
            3,    4,    4,    4,    4,    5,    5,   15,   15
    ];

    protected array $ruleToLength = [
            1,    1,    3,    3,    1,    1,    1,    2,    3,    1,
            1,    2,    1,    1,    1,    1,    1,    1,    1,    2,
            2,    3,    2,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            4,    4,    3,    4,    1,    1,    1,    1,    1,    1,
            1,    3,    1,    2,    3,    1,    2,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    3,    2
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
        "type : regex_string",
        "regex_string : TOKEN_REGEX_STR_PREFIX raw_string",
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
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            19 => function ($stackPos) {
                 $this->semValue = new Node(Type::REGEX_STRING());
                                                      $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            20 => function ($stackPos) {
                 $this->semValue = $this->semValue = new Node(Type::ARRAY());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            21 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            22 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue('\\' . $this->semValue->getValue());
            },
            23 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            24 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAYKEY());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_NULL());
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::SCALAR());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::NUMBER());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::MIXED());
            },
            29 => function ($stackPos) {
                 $this->semValue = new Node(Type::VOID());
            },
            30 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC_OR_DICT());
            },
            31 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC());
            },
            32 => function ($stackPos) {
                 $this->semValue = new Node(Type::DICT());
            },
            33 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEYSET());
            },
            34 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_EMPTY());
            },
            35 => function ($stackPos) {
                 $this->semValue = new Node(Type::EMPTY());
            },
            36 => function ($stackPos) {
                 $this->semValue = new Node(Type::TRUE());
            },
            37 => function ($stackPos) {
                 $this->semValue = new Node(Type::FALSE());
            },
            38 => function ($stackPos) {
                 $this->semValue = new Node(Type::POSITIVE());
            },
            39 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATIVE());
            },
            40 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            41 => function ($stackPos) {
                 $this->semValue = new Node(Type::SHAPE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            42 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-1)])->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            43 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild(
                                            (new Node(Type::OPTIONAL()))
                                                ->appendChild($this->semStack[$stackPos-(4-2)])
                                        )->appendChild($this->semStack[$stackPos-(4-4)]);
            },
            44 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            45 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            46 => function ($stackPos) {
                 $this->semValue = new Node(Type::ELLIPSIS());
            },
            47 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            48 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            49 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_INTEGER());
                                        $this->semValue->setValue(intval($this->semStack[$stackPos-(1-1)]));
            },
            50 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_FLOAT());
                                        $this->semValue->setValue(floatval($this->semStack[$stackPos-(1-1)]));
            },
            51 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                                          $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            52 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            53 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            54 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            55 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            56 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            57 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            58 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            59 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            60 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            61 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            62 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            63 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            64 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            65 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            66 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
            67 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(3-2)]->getChildren());
            },
            68 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
            },
        ];
    }
}
