%{

#include <string>
#include <iostream>
#include <variant>

class Node
{
};

// std::variant<Node> ast;
Node ast;

%}

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

%%

root : type                 { ast = $1; }
     ;

union_type : type TOKEN_UNION union_type
           { $$ = new Node(Type::UNION);
           $$->appendChild($1)->appendChild($3); }
           ;

intersection_type : type TOKEN_INTERSECTION intersection_type
                  { $$ = new Node(Type::INTERSECTION);
                  $$->appendChild($1)->appendChild($3); }
                  ;

type : scalar_type                    { $$ = $1; }
     | compound_type                  { $$ = $1; }
     | special_type                   { $$ = $1; }
     | other_type                     { $$ = $1; }
     | nullable_type                  { $$ = $1; }
     | negated_type                   { $$ = $1; }
     | PAREN_LEFT type PAREN_RIGHT    { $$ = $2; }
     | tuple
     | shape
     | union_type           { $$ = $1; }
     | intersection_type    { $$ = $1; }
     ;

nullable_type : PREFIX_NULLABLE type    { $$ = new Node(Type::NULLABLE); $$->appendChild($2); }
              ;

negated_type : PREFIX_NEGATED type    { $$ = new Node(Type::NEGATED); $$->appendChild($2); }
             ;

tuple : TYPE_TUPLE PAREN_LEFT tuple_list PAREN_RIGHT    { $$ = new Node(Type::TUPLE); $$->appendChildren($3); }
      ;

tuple_list : /* empty */
           ;

shape : TYPE_SHAPE PAREN_LEFT shape_list PAREN_RIGHT    { $$ = new Node(Type::SHAPE); $$->appendChildren($3); }
      ;

shape_list : /* empty */
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
             | TYPE_NULL        { $$ = new Node(Type::NULL); }
             ;

other_type : helper_type          { $$ = $1; }
           | generic_type         { $$ = $1; }
           | collection_type      { $$ = $1; }
           | user_defined_type    { $$ = $1; }
           ;

collection_type : TYPE_VEC            { $$ = new Node(Type::VEC); }
                | TYPE_DICT           { $$ = new Node(Type::DICT); }
                | TYPE_KEYSET         { $$ = new Node(Type::KEYSET); }
                | TYPE_VEC_OR_DICT    { $$ = new Node(Type::VEC_OR_DICT); }
                ;

user_defined_type : TYPE_USER_DEFINED    { $$ = new Node(Type::USER_DEFINED); }
                  ;

helper_type : TYPE_NOT_NULL         { $$ = new Node(Type::NOT_NULL); }
            | TYPE_COUNTABLE        { $$ = new Node(Type::COUNTABLE); }
            | TYPE_NUMERIC          { $$ = new Node(Type::NUMERIC); }
            | TYPE_SCALAR           { $$ = new Node(Type::SCALAR); }
            | TYPE_NUMBER           { $$ = new Node(Type::NUMBER); }
            | TYPE_MIXED            { $$ = new Node(Type::MIXED); }
            | TYPE_VOID             { $$ = new Node(Type::VOID); }
            | TYPE_ARRAYKEY         { $$ = new Node(Type::ARRAYKEY); }
            | TYPE_CLASSNAME        { $$ = new Node(Type::CLASSNAME); }
            | TYPE_INTERFACENAME    { $$ = new Node(Type::INTERFACENAME); }
            | TYPE_TRAITNAME        { $$ = new Node(Type::TRAITNAME); }
            | TYPE_EMPTY            { $$ = new Node(Type::EMPTY); }
            | TYPE_NOT_EMPTY        { $$ = new Node(Type::NOT_EMPTY); }
            | TYPE_CHAR             { $$ = new Node(Type::CHAR); }
            | TYPE_STRINGISH        { $$ = new Node(Type::STRINGISH); }
            | TYPE_TRUE             { $$ = new Node(Type::TRUE); }
            | TYPE_FALSE            { $$ = new Node(Type::FALSE); }
            | TYPE_POSITIVE         { $$ = new Node(Type::POSITIVE); }
            | TYPE_NOT_POSITIVE     { $$ = new Node(Type::NOT_POSITIVE); }
            | TYPE_NEGATIVE         { $$ = new Node(Type::NEGATIVE); }
            | TYPE_NOT_NEGATIVE     { $$ = new Node(Type::NOT_NEGATIVE); }
            ;

generic_type : TYPE_ARRAY GENERIC_LIST_START generic_list GENERIC_LIST_END
             | collection_type GENERIC_LIST_START generic_list GENERIC_LIST_END
             ;

generic_list : non_empty_generic_list
             | TYPE_PLACEHOLDER
             | /* empty */
             ;

non_empty_generic_list : non_empty_generic_list TOKEN_COMMA type    { $$ = list_add($1, $3); }
	                   | type                                       { $$ = create_list($1); }
                       ;

%%

int main()
{
    yyparse();
    std::cout << ast.print() << "\n";

    return 0;
}

void yyerror(std::string str) {
    std::cerr << str << "\n";
}
