
#pragma once

#include <iostream>
#include <string>

#include "Type.cpp"

std::string nodeTypeToJson(Type type)
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
	}

	std::cerr << "Received unknown node type: " << type << "\n";
	exit(1);
}
