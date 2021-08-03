#!/bin/bash

rm types.cpp
bison types.y -o types.cpp &&
  g++ -pipe -time -static -std=c++17 types.cpp
