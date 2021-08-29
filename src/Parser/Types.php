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

    protected int $tokenToSymbolMapSize = 319;
    protected int $actionTableSize = 69;
    protected int $gotoTableSize = 22;

    protected int $invalidSymbol = 64;
    protected int $errorSymbol = 1;
    protected int $defaultAction = -32766;
    protected int $unexpectedTokenRule = 32767;

    protected int $YY2TBLSTATE = 15;
    protected int $numNonLeafStates = 34;

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
        "TOKEN_FORMAT_STR_PREFIX",
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
            0,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,   64,   64,   64,   64,
           64,   64,   64,   64,   64,   64,    1,   49,    2,    3,
            4,    5,    6,    7,    8,    9,   10,   11,   12,   50,
           51,   13,   14,   15,   16,   17,   52,   53,   54,   18,
           19,   20,   21,   22,   23,   24,   25,   55,   56,   26,
           27,   28,   57,   29,   58,   30,   59,   31,   32,   33,
           34,   35,   36,   37,   38,   39,   60,   61,   40,   41,
           42,   43,   44,   62,   63,   45,   46,   47,   48
    ];

    protected array $action = [
           93,   94,   95,   96,   23,   98,   99,  100,  101,  102,
           61,   62,   63,   64,   65,   60,   24,   25,   67,   68,
           69,   66,   71,   70,   72,   73,   74,   75,   26,   15,
            4,    5,    6,   26,   15,    7,    8,   19,   83,   84,
            0,   83,   84,   85,   86,   16,   17,   82,   18,    2,
           11,    9,    1,   42,   77,   76,  103,    3,   12,    0,
           10,    0,    0,    0,    0,    0,    0,    0,  104
    ];

    protected array $actionCheck = [
            2,    3,    4,    5,    6,    7,    8,    9,   10,   11,
           12,   13,   14,   15,   16,   17,   18,   19,   20,   21,
           22,   23,   24,   25,   26,   27,   28,   29,   30,   31,
           32,   33,   34,   30,   31,   38,   39,   32,   40,   41,
            0,   40,   41,   45,   46,   47,   48,   42,   31,   34,
           34,   37,   43,   35,   35,   35,   44,   36,   36,   -1,
           37,   -1,   -1,   -1,   -1,   -1,   -1,   -1,   44
    ];

    protected array $actionBase = [
           -2,   24,   -2,   -2,   -2,   -2,   -2,   -2,   -2,   -2,
           -2,    5,    5,   18,   21,    3,    1,    1,    3,    1,
           -3,   -3,   -3,    9,   16,   15,   17,   40,   12,   14,
           19,   22,   20,   23,    0,   -2,    0,    0,    0,    0,
            0,    0,    0,    0,    0,    1,    1,   -3,   -3
    ];

    protected array $actionDefault = [
        32767,32767,32767,   58,32767,32767,32767,32767,32767,32767,
        32767,32767,   55,32767,   57,32767,32767,32767,32767,32767,
            1,   44,   45,   63,32767,32767,   25,32767,32767,32767,
        32767,   54,32767,32767
    ];

    protected array $goto = [
           58,   20,   87,   57,    0,   41,   45,   13,   36,   37,
           21,   22,    0,   29,   29,   32,   90,    0,   54,   55,
            0,   33
    ];

    protected array $gotoCheck = [
            9,    2,   18,    9,   -1,    2,    2,    2,    2,    2,
            2,    2,   -1,   10,   10,   17,   17,   -1,   10,   10,
           -1,   10
    ];

    protected array $gotoBase = [
            0,    0,    1,    0,    0,    0,    0,    0,    0,  -15,
            2,    0,    0,    0,    0,    0,    0,   13,  -10,    0,
            0,    0
    ];

    protected array $gotoDefault = [
        -32768,   27,   14,   38,   39,   40,   43,   44,   46,   47,
           48,   49,   50,   51,   52,   53,   56,   28,   30,   80,
           81,   31
    ];

    protected array $ruleToNonTerminal = [
            0,    1,    2,    2,    2,    2,    2,    2,    2,    2,
            2,    2,    2,    2,    2,    2,    2,    2,    2,    2,
           14,   15,   13,    9,    9,    9,    8,    8,    8,    8,
            8,    8,    8,    8,    8,    8,    8,    8,    8,    8,
            8,    8,    6,    7,   19,   20,   21,   21,   21,   10,
           10,   11,   12,   18,   18,   18,   17,   17,   17,    3,
            3,    3,    3,    4,    4,    4,    4,    5,    5,   16,
           16
    ];

    protected array $ruleToLength = [
            1,    1,    3,    3,    1,    1,    1,    2,    3,    1,
            1,    2,    1,    1,    1,    1,    1,    1,    1,    1,
            2,    2,    2,    3,    2,    1,    1,    1,    1,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    1,
            1,    1,    4,    4,    3,    4,    1,    1,    1,    1,
            1,    1,    1,    3,    1,    2,    3,    1,    2,    1,
            1,    1,    1,    1,    1,    1,    1,    1,    1,    3,
            2
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
        "type : format_string",
        "regex_string : TOKEN_REGEX_STR_PREFIX raw_string",
        "format_string : TOKEN_FORMAT_STR_PREFIX raw_string",
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
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            20 => function ($stackPos) {
                 $this->semValue = new Node(Type::REGEX_STRING());
                                                      $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            21 => function ($stackPos) {
                 $this->semValue = new Node(Type::FORMAT_STRING());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            22 => function ($stackPos) {
                 $this->semValue = $this->semValue = new Node(Type::ARRAY());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-2)]);
            },
            23 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)]; $this->semValue->setValue($this->semStack[$stackPos-(3-1)] . '\\' . $this->semValue->getValue());
            },
            24 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(2-2)]; $this->semValue->setValue('\\' . $this->semValue->getValue());
            },
            25 => function ($stackPos) {
                 $this->semValue = new Node(Type::USER_DEFINED(), $this->semStack[$stackPos-(1-1)]);
            },
            26 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAYKEY());
            },
            27 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_NULL());
            },
            28 => function ($stackPos) {
                 $this->semValue = new Node(Type::SCALAR());
            },
            29 => function ($stackPos) {
                 $this->semValue = new Node(Type::NUMBER());
            },
            30 => function ($stackPos) {
                 $this->semValue = new Node(Type::MIXED());
            },
            31 => function ($stackPos) {
                 $this->semValue = new Node(Type::VOID());
            },
            32 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC_OR_DICT());
            },
            33 => function ($stackPos) {
                 $this->semValue = new Node(Type::VEC());
            },
            34 => function ($stackPos) {
                 $this->semValue = new Node(Type::DICT());
            },
            35 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEYSET());
            },
            36 => function ($stackPos) {
                 $this->semValue = new Node(Type::NOT_EMPTY());
            },
            37 => function ($stackPos) {
                 $this->semValue = new Node(Type::EMPTY());
            },
            38 => function ($stackPos) {
                 $this->semValue = new Node(Type::TRUE());
            },
            39 => function ($stackPos) {
                 $this->semValue = new Node(Type::FALSE());
            },
            40 => function ($stackPos) {
                 $this->semValue = new Node(Type::POSITIVE());
            },
            41 => function ($stackPos) {
                 $this->semValue = new Node(Type::NEGATIVE());
            },
            42 => function ($stackPos) {
                 $this->semValue = new Node(Type::TUPLE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            43 => function ($stackPos) {
                 $this->semValue = new Node(Type::SHAPE());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(4-3)]->getChildren());
            },
            44 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild($this->semStack[$stackPos-(3-1)])->appendChild($this->semStack[$stackPos-(3-3)]);
            },
            45 => function ($stackPos) {
                 $this->semValue = new Node(Type::KEY_VALUE_PAIR());
                                        $this->semValue->appendChild(
                                            (new Node(Type::OPTIONAL()))
                                                ->appendChild($this->semStack[$stackPos-(4-2)])
                                        )->appendChild($this->semStack[$stackPos-(4-4)]);
            },
            46 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            47 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(1-1)];
            },
            48 => function ($stackPos) {
                 $this->semValue = new Node(Type::ELLIPSIS());
            },
            49 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            50 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_STRING());
                                        $this->semValue->setValue(substr($this->semStack[$stackPos-(1-1)], 1, -1));
            },
            51 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_INTEGER());
                                        $this->semValue->setValue(intval($this->semStack[$stackPos-(1-1)]));
            },
            52 => function ($stackPos) {
                 $this->semValue = new Node(Type::RAW_FLOAT());
                                        $this->semValue->setValue(floatval($this->semStack[$stackPos-(1-1)]));
            },
            53 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                                          $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            54 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            55 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                                      $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            56 => function ($stackPos) {
                 $this->semValue = $this->semStack[$stackPos-(3-3)];
                                                        $this->semValue->prependChild($this->semStack[$stackPos-(3-1)]);
            },
            57 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(1-1)]);
            },
            58 => function ($stackPos) {
                 $this->semValue = new Node(Type::LIST());
                                                        $this->semValue->appendChild($this->semStack[$stackPos-(2-1)]);
            },
            59 => function ($stackPos) {
                 $this->semValue = new Node(Type::BOOL());
            },
            60 => function ($stackPos) {
                 $this->semValue = new Node(Type::INT());
            },
            61 => function ($stackPos) {
                 $this->semValue = new Node(Type::FLOAT());
            },
            62 => function ($stackPos) {
                 $this->semValue = new Node(Type::STRING());
            },
            63 => function ($stackPos) {
                 $this->semValue = new Node(Type::ARRAY());
            },
            64 => function ($stackPos) {
                 $this->semValue = new Node(Type::OBJECT());
            },
            65 => function ($stackPos) {
                 $this->semValue = new Node(Type::CALLABLE());
            },
            66 => function ($stackPos) {
                 $this->semValue = new Node(Type::ITERABLE());
            },
            67 => function ($stackPos) {
                 $this->semValue = new Node(Type::RESOURCE());
            },
            68 => function ($stackPos) {
                 $this->semValue = new Node(Type::NULL());
            },
            69 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
                                        $this->semValue->appendChildren($this->semStack[$stackPos-(3-2)]->getChildren());
            },
            70 => function ($stackPos) {
                 $this->semValue = new Node(Type::GENERIC_LIST());
            },
        ];
    }
}
