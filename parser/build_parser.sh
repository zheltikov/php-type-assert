#!/bin/bash

yacc -d types.y
lex types.l
gcc -pipe -time -static lex.yy.c y.tab.c -o parser
