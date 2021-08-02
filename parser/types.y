%{

extern int yylex();
void yyerror(char *s);

#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>
#include <stdarg.h>

char *transpiled_code;
char *my_sprintf(const char *fmt, ...);

%}

%union { int num; char id; char *string; }

%start code

%token print
%token exit_command
%token <num> number
%token <id> identifier

%type <string> line exp term
%type <string> assignment

%%

code : line    { transpiled_code = my_sprintf("<?php %s", $1); }
     ;

line : assignment ';'           { $$ = my_sprintf("%s;", $1); }
     | exit_command ';'         { $$ = my_sprintf("exit();"); }
     | print exp ';'            { $$ = my_sprintf("echo %s;", $2); }
     | line assignment ';'      { $$ = my_sprintf("%s%s;", $1, $2); }
     | line print exp ';'       { $$ = my_sprintf("%secho %s;", $1, $3); }
     | line exit_command ';'    { $$ = my_sprintf("%sexit();", $1); }
     ;

assignment : identifier '=' exp    { $$ = my_sprintf("$%c=%s", $1, $3); }
           ;

exp : term            { $$ = my_sprintf("%s", $1); }
    | exp '+' term    { $$ = my_sprintf("%s+%s", $1, $3); }
    | exp '-' term    { $$ = my_sprintf("%s-%s", $1, $3); }
    ;

term : number        { $$ = my_sprintf("%d", $1); }
     | identifier    { $$ = my_sprintf("$%c", $1); }
     ;

%%

char *my_sprintf(const char *fmt, ...)
{
        static char *buffer;
        buffer = (char *) malloc(1024 * sizeof(char) + 1);
        va_list args;

        va_start(args, fmt);
        vsprintf(buffer, fmt, args);
        va_end(args);

        return buffer;
}

int main()
{
        transpiled_code = (char *) malloc(1024 * sizeof(char) + 1);

        yyparse();
        printf("%s\n", transpiled_code);

        return 0;
}

void yyerror(char *s) {
        fprintf(stderr, "%s\n", s);
}
