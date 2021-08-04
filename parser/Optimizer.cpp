
#pragma once

#include <type_traits>

#include "Node.cpp"

class Optimizer
{
 private:
	Node* root;
 public:
	Optimizer();
	Optimizer(Node*);

	auto setRoot(Node*);
	Node* getRoot() const;

	void execute();
 protected:
	void unwrapUnions();
};

// -----------------------------------------------------------------------------

Optimizer::Optimizer()
{

}

Node* Optimizer::getRoot() const
{
	return root;
}

void Optimizer::execute()
{
	std::cout << "\nUnoptimized: " << root->toJson() << "\n";

	std::string serialized;
	auto i = 1;

	while (serialized.compare(root->toJson()) != 0) {
		serialized = root->toJson();
		unwrapUnions();
		i++;
	}

	std::cout << "\nOptimized: " << root->toJson() << "\n";
	std::cout << "\n" << i << " optimization iterations.\n";
}

void Optimizer::unwrapUnions()
{
	Node* node = root->getFirstByType(Type::UNION);
	if (node != nullptr) {
		static_assert(std::is_same<decltype(node), Node*>::value, "Node must be of type Node*");

		if (node->hasChildOfType(Type::UNION)) {
			Node* new_node = new Node(Type::UNION);

			for (auto* child: node->getChildren()) {
				if (child->getType() == Type::UNION) {
					new_node->appendChildren(child->getChildren());
					delete child;
				} else {
					new_node->appendChild(child);
				}
			}

			*node = *new_node;
		}
	}
}

auto Optimizer::setRoot(Node* root)
{
	this->root = root;
	return this;
}

Optimizer::Optimizer(Node* root)
{
	setRoot(root);
}

