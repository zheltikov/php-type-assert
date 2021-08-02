#!/bin/bash

bison types.y -o types.cpp
# flex types.l
# g++ -pipe -time -static lex.yy.c types.tab.c -o parser
g++ -pipe -time -static types.cpp
