#!/bin/bash

# TODO: use re2c

rm types.cpp
bison types.y -o types.cpp &&
  re2c types.l -o types.hpp &&
  g++ -pipe -time -static -std=c++17 types.cpp -o parser
