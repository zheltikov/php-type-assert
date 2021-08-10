
#pragma once

#include <vector>
#include <string>
#include <variant>

#include "Type.cpp"
#include "utils.cpp"

class Node
{
 private:
	Type type;
	std::vector<Node> children;

 public:
	Node(Type type);
	~Node();
	auto prependChild(Node child);
	auto appendChild(Node child);
	auto appendChildren(std::vector<Node> children);
	std::string toJson() const;

	std::variant<Node, std::nullptr_t> getFirstByType(Type) const;
	bool hasChildOfType(Type) const;
	std::vector<Node> getChildren() const;
	int hasChildren() const;
	Type getType() const;
};

// -----------------------------------------------------------------------------

Node::Node(Type type)
{
	// std::cout << "(node " << type << ")";
	this->type = type;
}

Node::~Node()
{
	// std::cout << "(~node " << type << ")";
}

auto Node::prependChild(Node child)
{
	children.insert(children.begin(), child);
	return *this;
}

auto Node::appendChild(Node child)
{
	children.push_back(child);
	return *this;
}

auto Node::appendChildren(std::vector<Node> children)
{
	for (auto child : children) {
		this->appendChild(child);
	}
	return *this;
}

std::string Node::toJson() const
{
	std::string result;
	int count = children.size();
	bool human_readable = true;
	int i = 1;

	if (human_readable) {
		result += nodeTypeToString(type);

		if (count) { result += '<'; }
		for (auto child : children) {
			result += child.toJson();
			if (i < count) { result += ", "; }
			i++;
		}
		if (count) { result += '>'; }
	} else {
		result += "{\"type\":\"" + nodeTypeToString(type) + "\"";

		if (count) { result += ",\"children\":["; }
		for (auto child : children) {
			result += child.toJson();
			if (i < count) { result += ','; }
			i++;
		}
		if (count) { result += ']'; }

		result += '}';
	}

	return result;
}

std::variant<Node, std::nullptr_t> Node::getFirstByType(Type type) const
{
	if (this->type == type) {
		return *this;
	}

	for (auto child : children) {
		if (child.getType() == type) {
			return child;
		}

		if (child.hasChildren()) {
			std::variant<Node, std::nullptr_t> result = child.getFirstByType(type);
			if (std::holds_alternative<Node>(result)) {
				return std::get<Node>(result);
			}
		}
	}

	return nullptr;
}

bool Node::hasChildOfType(Type type) const
{
	for (auto child : children) {
		if (child.getType() == type) {
			return true;
		}
	}

	return false;
}

std::vector<Node> Node::getChildren() const
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
