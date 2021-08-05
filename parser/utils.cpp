
#pragma once

#include <iostream>
#include <string>
#include <map>

#include "Type.cpp"

std::string nodeTypeToString(Type type)
{
	switch (type) {
	case Type::UNION:
		return "union";
	case Type::STRING:
		return "string";
	case Type::BOOL:
		return "bool";
	case Type::INT:
		return "int";
	case Type::ARRAY:
		return "array";
	case Type::OBJECT:
		return "object";
	case Type::FLOAT:
		return "float";
	case Type::CALLABLE:
		return "callable";
	case Type::ITERABLE:
		return "iterable";
	case Type::RESOURCE:
		return "resource";
	case Type::_NULL:
		return "null";
	case Type::NULLABLE:
		return "nullable";
	case Type::TUPLE:
		return "tuple";
	}

	std::cerr << "Received unknown node type: " << type << "\n";
	exit(1);
}

template<typename T, typename V>
bool map_key_exists(std::map<T, V> map, T key)
{
	for (auto pair: map) {
		if (pair.first == key) {
			return true;
		}
	}
	return false;
}
