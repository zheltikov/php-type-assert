
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
	std::vector<std::variant<Node, std::nullptr_t>> children;

 public:
	Node();
	Node(Type type);
	~Node();
	auto prependChild(Node child);
	auto appendChild(Node child);
	auto appendChildren(std::vector<std::variant<Node, std::nullptr_t>> children);
	std::string toJson() const;

	std::variant<Node, std::nullptr_t> getFirstByType(Type) const;
	bool hasChildOfType(Type) const;
	std::vector<std::variant<Node, std::nullptr_t>> getChildren() const;
	int hasChildren() const;
	Type getType() const;
	auto setType(Type);

	auto deleteChild(Node&);
};

// -----------------------------------------------------------------------------

Node::Node()
{
	std::cout << "NONONONO!!!!\n";
}

auto Node::setType(Type type)
{
	this->type = type;
	return *this;
}

auto Node::deleteChild(Node& child_to_remove)
{
	for (auto& child : children) {
		if (&std::get<Node>(child) == &child_to_remove) {
			child = nullptr;
		}
	}

	return *this;
}

Node::Node(Type type)
{
	//std::cout << "(node " << type << ")";
	setType(type);
}

Node::~Node()
{
	//std::cout << "(~node " << type << ")";
}

auto Node::prependChild(Node child)
{
	children.insert(children.begin(), child);
	return *this;
}

auto Node::appendChild(Node child)
{
	if (type == Type::UNION) {
		std::cout << "Appending to UNION (" << this->toJson() << "): " << child.toJson() << "\n";
	}
	children.push_back(child);
	if (type == Type::UNION) {
		std::cout << "After Appending to UNION (" << this->toJson() << ")\n\n";
	}
	return *this;
}

auto Node::appendChildren(std::vector<std::variant<Node, std::nullptr_t>> children)
{
	for (auto child : children) {
		if (std::holds_alternative<Node>(child)) {
			this->appendChild(std::get<Node>(child));
		}
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
			result += std::holds_alternative<Node>(child) ? std::get<Node>(child).toJson() : "~";
			if (i < count) { result += ", "; }
			i++;
		}
		if (count) { result += '>'; }
	} else {
		result += "{\"type\":\"" + nodeTypeToString(type) + "\"";

		if (count) { result += ",\"children\":["; }
		for (auto child : children) {
			result += std::holds_alternative<Node>(child) ? std::get<Node>(child).toJson() : "~";
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
		if (std::get<Node>(child).getType() == type) {
			return child;
		}

		if (std::get<Node>(child).hasChildren()) {
			std::variant<Node, std::nullptr_t> result = std::get<Node>(child).getFirstByType(type);
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
		if (std::get<Node>(child).getType() == type) {
			return true;
		}
	}

	return false;
}

std::vector<std::variant<Node, std::nullptr_t>> Node::getChildren() const
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
