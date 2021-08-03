#!/bin/bash

# TODO: use re2c

rm types.cpp
bison types.y -o types.cpp &&
  flex types.l &&
  g++ -pipe -time -static -std=c++17 types.cpp -o parser
