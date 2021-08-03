#!/bin/bash

# TODO: use re2c

rm parser.cpp lexer.cpp
bison types.y -o parser.cpp &&
  re2c types.l -o lexer.cpp &&
  g++ -pipe -time -static -std=c++17 main.cpp -o parser
