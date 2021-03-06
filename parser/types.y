%pure_parser
%expect 2

%tokens

%left TOKEN_UNION TOKEN_INTERSECTION
%right PREFIX_NULLABLE PREFIX_NEGATED

%%

root : type                 { $$ = $1; }
     ;

type : type TOKEN_UNION type          {
                                        $$ = new Node(Type::UNION());
                                        if ($1->getType()->equals(Type::UNION())) {
                                            $$->appendChildren($1->getChildren());
                                        } else {
                                            $$->appendChild($1);
                                        }
                                        if ($3->getType()->equals(Type::UNION())) {
                                            $$->appendChildren($3->getChildren());
                                        } else {
                                            $$->appendChild($3);
                                        }
                                      }
     | type TOKEN_INTERSECTION type   {
                                        $$ = new Node(Type::INTERSECTION());
                                        if ($1->getType()->equals(Type::INTERSECTION())) {
                                            $$->appendChildren($1->getChildren());
                                        } else {
                                            $$->appendChild($1);
                                        }
                                        if ($3->getType()->equals(Type::INTERSECTION())) {
                                            $$->appendChildren($3->getChildren());
                                        } else {
                                            $$->appendChild($3);
                                        }
                                      }
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
     | raw_string                     { $$ = $1; }
     | raw_integer                    { $$ = $1; }
     | raw_float                      { $$ = $1; }
     | generic_array                  { $$ = $1; }
     | regex_string                   { $$ = $1; }
     | format_string                  { $$ = $1; }
     ;

regex_string : TOKEN_REGEX_STR_PREFIX raw_string    { $$ = new Node(Type::REGEX_STRING());
                                                      $$->appendChild($2); }
             ;

format_string : TOKEN_FORMAT_STR_PREFIX raw_string    { $$ = new Node(Type::FORMAT_STRING());
                                                        $$->appendChild($2); }
              ;

generic_array : TYPE_ARRAY generic_list
                                      { $$ = $$ = new Node(Type::ARRAY());
                                        $$->appendChild($2); }
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
            | TYPE_INTABLE              { $$ = new Node(Type::INTABLE()); }
            ;

tuple : TYPE_TUPLE PAREN_LEFT type_comma_list PAREN_RIGHT
                                      { $$ = new Node(Type::TUPLE());
                                        $$->appendChildren($3->getChildren()); }
      ;

shape : TYPE_SHAPE PAREN_LEFT key_value_pair_list PAREN_RIGHT
                                      { $$ = new Node(Type::SHAPE());
                                        $$->appendChildren($3->getChildren()); }
      ;

key_value_pair : raw_string TOKEN_ARROW type
                                      { $$ = new Node(Type::KEY_VALUE_PAIR());
                                        $$->appendChild($1)->appendChild($3); }

               | raw_integer TOKEN_ARROW type
                                      { $$ = new Node(Type::KEY_VALUE_PAIR());
                                        $$->appendChild($1)->appendChild($3); }
               ;

optional_key_value_pair : PREFIX_NULLABLE raw_string TOKEN_ARROW type
                                      { $$ = new Node(Type::KEY_VALUE_PAIR());
                                        $$->appendChild(
                                            (new Node(Type::OPTIONAL()))
                                                ->appendChild($2)
                                        )->appendChild($4); }

                        | PREFIX_NULLABLE raw_integer TOKEN_ARROW type
                                      { $$ = new Node(Type::KEY_VALUE_PAIR());
                                        $$->appendChild(
                                            (new Node(Type::OPTIONAL()))
                                                ->appendChild($2)
                                        )->appendChild($4); }
                        ;

any_key_value_pair : key_value_pair             { $$ = $1; }
                   | optional_key_value_pair    { $$ = $1; }
                   | TOKEN_ELLIPSIS             { $$ = new Node(Type::ELLIPSIS()); }
                   ;

raw_string : TOKEN_STRING_DQ          { $$ = new Node(Type::RAW_STRING());
                                        $$->setValue(substr($1, 1, -1)); }
           | TOKEN_STRING_SQ          { $$ = new Node(Type::RAW_STRING());
                                        $$->setValue(substr($1, 1, -1)); }
           ;

raw_integer : TOKEN_RAW_INTEGER       { $$ = new Node(Type::RAW_INTEGER());
                                        $$->setValue(intval($1)); }
            ;

raw_float : TOKEN_RAW_FLOAT           { $$ = new Node(Type::RAW_FLOAT());
                                        $$->setValue(floatval($1)); }
          ;

key_value_pair_list : any_key_value_pair TOKEN_COMMA key_value_pair_list    { $$ = $3;
                                                                          $$->prependChild($1); }
                    | any_key_value_pair                                { $$ = new Node(Type::LIST());
                                                                      $$->appendChild($1); }
                    | any_key_value_pair TOKEN_COMMA                    { $$ = new Node(Type::LIST());
                                                                      $$->appendChild($1); }
                    ;

type_comma_list : type TOKEN_COMMA type_comma_list    { $$ = $3;
                                                        $$->prependChild($1); }
                | type                                { $$ = new Node(Type::LIST());
                                                        $$->appendChild($1); }
                | type TOKEN_COMMA                    { $$ = new Node(Type::LIST());
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

generic_list : TOKEN_ANGLE_LEFT type_comma_list TOKEN_ANGLE_RIGHT
                                      { $$ = new Node(Type::GENERIC_LIST());
                                        $$->appendChildren($2->getChildren()); }
             | TOKEN_ANGLE_LEFT TOKEN_ANGLE_RIGHT
                                      { $$ = new Node(Type::GENERIC_LIST()); }
             ;

%%

