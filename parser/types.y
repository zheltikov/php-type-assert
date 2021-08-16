%pure_parser
%expect 2

%tokens

%%

root : type                 { $$ = $1; }
     | raw_string           { $$ = new Node(
                                Type::RAW_STRING(),
                                eval(sprintf('return (string) %s;', $1))
                            ); /* FIXME: This string parsing method is not quite good */ }
     ;

type : type TOKEN_UNION type          { $$ = new Node(Type::UNION());
                                        $$->appendChild($1)->appendChild($3); }
     | type TOKEN_INTERSECTION type   { $$ = new Node(Type::INTERSECTION());
                                        $$->appendChild($1)->appendChild($3); }
     | scalar_type                    { $$ = $1; }
     | compound_type                  { $$ = $1; }
     | special_type                   { $$ = $1; }
     | PREFIX_NULLABLE type           { $$ = new Node(Type::NULLABLE());
                                        $$->appendChild($2); }
     | PAREN_LEFT type PAREN_RIGHT    { $$ = $2; }
     | tuple                          { $$ = $1; }
     | shape                          { $$ = $1; }
     | PREFIX_NEGATED type            { $$ = new Node(Type::NEGATED());
                                        $$->appendChild($2); }
     | custom_type                    { $$ = $1; }
     | user_defined_type              { $$ = $1; }
     ;

user_defined_type : TYPE_USER_DEFINED TOKEN_NS_SEPARATOR user_defined_type
                                        { $$ = $3; $$->setValue($1 . '\\' . $$->getValue()); }
                  | TOKEN_NS_SEPARATOR user_defined_type
                                        { $$ = $2; $$->setValue('\\' . $$->getValue()); }
                  | TYPE_USER_DEFINED   { $$ = new Node(Type::USER_DEFINED(), $1); }
                  ;

custom_type : TYPE_ARRAYKEY             { $$ = new Node(Type::ARRAYKEY()); }
            | TYPE_NOT_NULL             { $$ = new Node(Type::NOT_NULL()); }
            | TYPE_SCALAR               { $$ = new Node(Type::SCALAR()); }
            | TYPE_NUMBER               { $$ = new Node(Type::NUMBER()); }
            | TYPE_MIXED                { $$ = new Node(Type::MIXED()); }
            | TYPE_VOID                 { $$ = new Node(Type::VOID()); }
            | TYPE_VEC_OR_DICT          { $$ = new Node(Type::VEC_OR_DICT()); }
            | TYPE_VEC                  { $$ = new Node(Type::VEC()); }
            | TYPE_DICT                 { $$ = new Node(Type::DICT()); }
            | TYPE_KEYSET               { $$ = new Node(Type::KEYSET()); }
            | TYPE_NOT_EMPTY            { $$ = new Node(Type::NOT_EMPTY()); }
            | TYPE_EMPTY                { $$ = new Node(Type::EMPTY()); }
            | TYPE_TRUE                 { $$ = new Node(Type::TRUE()); }
            | TYPE_FALSE                { $$ = new Node(Type::FALSE()); }
            | TYPE_POSITIVE             { $$ = new Node(Type::POSITIVE()); }
            | TYPE_NEGATIVE             { $$ = new Node(Type::NEGATIVE()); }
            ;

tuple : TYPE_TUPLE PAREN_LEFT type_comma_list PAREN_RIGHT
                                      { $$ = new Node(Type::TUPLE());
                                        $$->appendChildren($3->getChildren()); }
      ;

shape : TYPE_SHAPE PAREN_LEFT PAREN_RIGHT
                                      { $$ = new Node(Type::SHAPE()); }
      ;

key_value_pair : raw_string TOKEN_ARROW type
                                      { $$ = new Node(Type::KEY_VALUE_PAIR(), $1);
                                        $$->appendChild($3); }
               ;

raw_string : TOKEN_STRING_DQ          { $$ = $1; }
           | TOKEN_STRING_SQ          { $$ = $1; }
           ;

type_comma_list : type TOKEN_COMMA type_comma_list    { $$ = $3;
                                                        $$->prependChild($1); }
                | type                                { $$ = new Node(Type::LIST());
                                                        $$->appendChild($1); }
                ;

scalar_type : TYPE_BOOL      { $$ = new Node(Type::BOOL()); }
            | TYPE_INT       { $$ = new Node(Type::INT()); }
            | TYPE_FLOAT     { $$ = new Node(Type::FLOAT()); }
            | TYPE_STRING    { $$ = new Node(Type::STRING()); }
            ;

compound_type : TYPE_ARRAY       { $$ = new Node(Type::ARRAY()); }
              | TYPE_OBJECT      { $$ = new Node(Type::OBJECT()); }
              | TYPE_CALLABLE    { $$ = new Node(Type::CALLABLE()); }
              | TYPE_ITERABLE    { $$ = new Node(Type::ITERABLE()); }
              ;

special_type : TYPE_RESOURCE    { $$ = new Node(Type::RESOURCE()); }
             | TYPE_NULL        { $$ = new Node(Type::NULL()); }
             ;

%%

