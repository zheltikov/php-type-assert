%{

#include <string>
#include <iostream>

%}

%start root

%%

root : type    { ast = $1; }
     ;

type : /* empty */    { $$ = null; }
     ;

%%

int main()
{
    std::variant ast;

    yyparse();
    std::cout << transpiled_code << "\n";

    return 0;
}

void yyerror(std::string str) {
    std::cerr << str << "\n";
}
