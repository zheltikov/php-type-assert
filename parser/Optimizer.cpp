
#pragma once

#include <type_traits>
#include <map>

#include "Node.cpp"

class Optimizer
{
 private:
	Node root;
 public:
	Optimizer();
	Optimizer(Node&);

	Optimizer setRoot(Node&);
	Node getRoot() const;

	void execute();
 protected:
	void unwrapUnions();
	void dedupeUnions();
	void nullableToUnion();
};

// -----------------------------------------------------------------------------

Optimizer::Optimizer()
{

}

Node Optimizer::getRoot() const
{
	return root;
}

void Optimizer::execute()
{
	return;
	std::cout << "Unoptimized:  " << root.toJson() << "\n";

	std::string serialized;
	auto i = 1;

	while (serialized.compare(root.toJson()) != 0) {
		serialized = root.toJson();

		unwrapUnions();
		dedupeUnions();
		nullableToUnion();

		std::cout << "Intermediate: " << root.toJson() << "\n";
		i++;
	}

	std::cout << "Optimized:    " << root.toJson() << "\n";
	std::cout << i << " optimization iterations.\n";
}

void Optimizer::unwrapUnions()
{
	std::variant<Node, std::nullptr_t> node = root.getFirstByType(Type::UNION);
	if (std::holds_alternative<Node>(node)) {

		if (std::get<Node>(node).hasChildOfType(Type::UNION)) {
			Node new_node = Node(Type::UNION);

			for (auto child: std::get<Node>(node).getChildren()) {
				if (std::get<Node>(child).getType() == Type::UNION) {
					new_node.appendChildren(std::get<Node>(child).getChildren());
					std::get<Node>(node).deleteChild(std::get<Node>(child));
				} else {
					new_node.appendChild(std::get<Node>(child));
				}
			}

			node = new_node;
		}
	}
}

void Optimizer::dedupeUnions()
{
	std::variant<Node, std::nullptr_t> node = root.getFirstByType(Type::UNION);
	if (std::holds_alternative<Node>(node)) {

		std::map<Type, int> counter;
		bool needs_optimization = false;

		for (auto child: std::get<Node>(node).getChildren()) {
			auto child_count = std::get<Node>(child).getChildren().size();
			if (child_count > 0) { continue; }

			auto type = std::get<Node>(child).getType();
			if (map_key_exists(counter, type)) {
				counter[type]++;
				needs_optimization = true;
			} else {
				counter[type] = 1;
			}
		}

		if (needs_optimization) {
			std::map<Type, int> just_added;
			Node new_node = Node(Type::UNION);
			for (auto child: std::get<Node>(node).getChildren()) {
				auto child_count = std::get<Node>(child).getChildren().size();
				if (child_count > 0) {
					new_node.appendChild(std::get<Node>(child));
				}

				auto type = std::get<Node>(child).getType();
				if (map_key_exists(counter, type)) {
					if (!map_key_exists(just_added, type)) {
						new_node.appendChild(std::get<Node>(child));
						just_added[std::get<Node>(child).getType()] = 1;
					} else {
						std::get<Node>(node).deleteChild(std::get<Node>(child));
					}
				} else {
					new_node.appendChild(std::get<Node>(child));
				}
			}
			node = new_node;
		}
	}
}

void Optimizer::nullableToUnion()
{
	std::variant<Node, std::nullptr_t> node = root.getFirstByType(Type::NULLABLE);
	if (std::holds_alternative<Node>(node)) {

		Node new_node = Node(Type::UNION);

		new_node.appendChild(Node(Type::_NULL))
			.appendChildren(std::get<Node>(node).getChildren());

		node = new_node;
	}
}

Optimizer Optimizer::setRoot(Node& root)
{
	this->root = root;
	return *this;
}

Optimizer::Optimizer(Node& root)
{
	setRoot(root);
}

