%pure_parser
%expect 2

%tokens

%%

root : type                 { $$ = $1; }
     ;

type : type TOKEN_UNION type          { $$ = new Node(Type::UNION());
                                        $$->appendChild($1)->appendChild($3); }
     | scalar_type                    { $$ = $1; }
     | compound_type                  { $$ = $1; }
     | special_type                   { $$ = $1; }
     | PREFIX_NULLABLE type           { $$ = new Node(Type::NULLABLE());
                                        $$->appendChild($2); }
     | PAREN_LEFT type PAREN_RIGHT    { $$ = $2; }
     | tuple                          { $$ = $1; }
     | PREFIX_NEGATED type            { $$ = new Node(Type::NEGATED());
                                        $$->appendChild($2); }
     ;

tuple : TYPE_TUPLE PAREN_LEFT type_comma_list PAREN_RIGHT
                                      { $$ = new Node(Type::TUPLE());
                                        $$->appendChildren($3->getChildren()); }
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

