
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

	Node* getFirstByType(Type) const;
	bool hasChildOfType(Type) const;
	std::vector<Node*> getChildren() const;
	int hasChildren() const;
	Type getType() const;
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
	// json += "{\"type\":" + nodeTypeToJson(type) + ",\"children\":[";
	json += nodeTypeToJson(type);

	int i = 1;
	int c = children.size();

	if (c) {
		json += '<';
	}

	for (auto* child : children) {
		json += child->toJson();
		if (i < c) { json += ", "; }
		i++;
	}
	if (c) {
		json += '>';
	}

	return json;
}

Node* Node::getFirstByType(Type type) const
{
	if (this->type == type) {
		return const_cast<Node*>(this);
	}

	for (auto* child : children) {
		if (child->getType() == type) {
			return child;
		}

		if (child->hasChildren()) {
			auto* result = child->getFirstByType(type);
			if (result != nullptr) {
				return result;
			}
		}
	}

	return nullptr;
}

bool Node::hasChildOfType(Type type) const
{
	for (auto* child : children) {
		if (child->getType() == type) {
			return true;
		}
	}

	return false;
}

std::vector<Node*> Node::getChildren() const
{
	return children;
}

int Node::hasChildren() const
{
	return children.size();
}

Type Node::getType() const
{
	return type;
}
