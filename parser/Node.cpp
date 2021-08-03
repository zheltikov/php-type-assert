
#pragma once

#include <vector>
#include <string>

#include "Type.cpp"
#include "utils.cpp"

class Node
{
 private:
	Type type;
	std::vector<Node*> children;

 public:
	Node(Type type);
	auto appendChild(Node* child);
	auto appendChildren(std::vector<Node*> children);
	std::string toJson() const;
};

// -----------------------------------------------------------------------------

Node::Node(Type type)
{
	std::cout << "(node " << type << ")";
	this->type = type;
}

auto Node::appendChild(Node* child)
{
	children.push_back(child);
	return this;
}

auto Node::appendChildren(std::vector<Node*> children)
{
	for (auto* child : children) {
		this->appendChild(child);
	}
	return this;
}

std::string Node::toJson() const
{
	std::string json;
	json += "{\"type\":" + nodeTypeToJson(type) + ",\"children\":[";

	int i = 1;
	int c = children.size();
	for (auto* child : children) {
		json += child->toJson();
		if (i < c) { json += ","; }
		i++;
	}
	json += "]}";

	return json;
}
