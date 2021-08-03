
%%

"bool"
| "boolean"         { return TYPE_BOOL; }

"int"
| "integer"
| "long"            { return TYPE_INT; }

"float"
| "double"
| "real"            { return TYPE_FLOAT; }

"string"            { return TYPE_STRING; }
"array"             { return TYPE_ARRAY; }
"object"            { return TYPE_OBJECT; }
"callable"          { return TYPE_CALLABLE; }
"iterable"          { return TYPE_ITERABLE; }
"resource"          { return TYPE_RESOURCE; }
"null"              { return TYPE_NULL; }

"nonnull"
| "notnull"         { return TYPE_NOT_NULL; }

"countable"         { return TYPE_COUNTABLE; }
"numeric"           { return TYPE_NUMERIC; }
"scalar"            { return TYPE_SCALAR; }

"num"
| "number"          { return TYPE_NUMBER; }

"mixed"
| "dynamic"
| "any"             { return TYPE_MIXED; }

"void"
| "nothing"         { return TYPE_VOID; }

"arraykey"          { return TYPE_ARRAYKEY; }
"classname"         { return TYPE_CLASSNAME; }
"interfacename"     { return TYPE_INTERFACENAME; }
"traitname"         { return TYPE_TRAITNAME; }
"shape"             { return TYPE_SHAPE; }

"vec"
| "varray"          { return TYPE_VEC; }

"dict"
| "darray"          { return TYPE_DICT; }

"keyset"            { return TYPE_KEYSET; }

"varray_or_darray"
| "vec_or_dict"     { return TYPE_VEC_OR_DICT; }

"empty"             { return TYPE_EMPTY; }

"nonempty"
| "notempty"        { return TYPE_NOT_EMPTY; }

"char"              { return TYPE_CHAR; }
"Stringish"         { return TYPE_STRINGISH; }
"true"              { return TYPE_TRUE; }
"false"             { return TYPE_FALSE; }
"positive"          { return TYPE_POSITIVE; }

"nonpositive"
| "notpositive"     { return TYPE_NOT_POSITIVE; }

"negative"          { return TYPE_NEGATIVE; }

"nonnegative"
| "notnegative"     { return TYPE_NOT_NEGATIVE; }

[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*
                    { return TYPE_USER_DEFINED; }

?                   { return PREFIX_NULLABLE; }
!                   { return PREFIX_NEGATED; }
(                   { return TUPLE_START; }
)                   { return TUPLE_END; }
,                   { return TOKEN_COMMA; }
=>                  { return TOKEN_ARROW; }
<                   { return GENERIC_LIST_START; }
>                   { return GENERIC_LIST_END; }

[ \t\n]             ;
.                   { yyerror("Unexpected character"); }

%%
