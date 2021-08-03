%{

#include <string>

#include "Type.cpp"
#include "Node.cpp"

%}

%define api.value.type { Node* }

%start root

%token TYPE_BOOL
%token TYPE_INT
%token TYPE_FLOAT
%token TYPE_STRING
%token TYPE_ARRAY
%token TYPE_OBJECT
%token TYPE_CALLABLE
%token TYPE_ITERABLE
%token TYPE_RESOURCE
%token TYPE_NULL
%token TYPE_NOT_NULL
%token TYPE_COUNTABLE
%token TYPE_NUMERIC
%token TYPE_SCALAR
%token TYPE_NUMBER
%token TYPE_MIXED
%token TYPE_VOID
%token TYPE_ARRAYKEY
%token TYPE_CLASSNAME
%token TYPE_INTERFACENAME
%token TYPE_TRAITNAME
%token TYPE_SHAPE
%token TYPE_TUPLE
%token TYPE_VEC
%token TYPE_DICT
%token TYPE_KEYSET
%token TYPE_VEC_OR_DICT
%token TYPE_EMPTY
%token TYPE_NOT_EMPTY
%token TYPE_CHAR
%token TYPE_STRINGISH
%token TYPE_TRUE
%token TYPE_FALSE
%token TYPE_POSITIVE
%token TYPE_NOT_POSITIVE
%token TYPE_NEGATIVE
%token TYPE_NOT_NEGATIVE
%token TYPE_USER_DEFINED
%token TYPE_PLACEHOLDER

%token PREFIX_NULLABLE
%token PREFIX_NEGATED
%token PAREN_LEFT
%token PAREN_RIGHT
%token TOKEN_COMMA
%token TOKEN_ARROW
%token GENERIC_LIST_START
%token GENERIC_LIST_END
%token TOKEN_UNION
%token TOKEN_INTERSECTION
%token TOKEN_WHITESPACE
%token TOKEN_ERROR

%%

root : type                 { ast = $1; return 0; }
     ;

type : type TOKEN_UNION type          { $$ = new Node(Type::UNION);
                                        $$->appendChild($1)->appendChild($3); }
     | scalar_type                    { $$ = $1; }
     | compound_type                  { $$ = $1; }
     | special_type                   { $$ = $1; }
     ;

scalar_type : TYPE_BOOL      { $$ = new Node(Type::BOOL); }
            | TYPE_INT       { $$ = new Node(Type::INT); }
            | TYPE_FLOAT     { $$ = new Node(Type::FLOAT); }
            | TYPE_STRING    { $$ = new Node(Type::STRING); }
            ;

compound_type : TYPE_ARRAY       { $$ = new Node(Type::ARRAY); }
              | TYPE_OBJECT      { $$ = new Node(Type::OBJECT); }
              | TYPE_CALLABLE    { $$ = new Node(Type::CALLABLE); }
              | TYPE_ITERABLE    { $$ = new Node(Type::ITERABLE); }
              ;

special_type : TYPE_RESOURCE    { $$ = new Node(Type::RESOURCE); }
             | TYPE_NULL        { $$ = new Node(Type::_NULL); }
             ;

%%

#include "lexer.cpp"
