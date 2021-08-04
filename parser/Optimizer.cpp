
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
	auto i = 0;
	std::cout << "\nUnoptimized: " << root->toJson() << "\n";

	while (i < 10) {
		unwrapUnions();

		std::cout << "\nOptimized: " << root->toJson() << "\n";
		i++;
	}
}

void Optimizer::unwrapUnions()
{
	std::cout << "?";
	Node* node = root->getFirstByType(Type::UNION);
	if (node != nullptr) {
		std::cout << "found";
		static_assert(std::is_same<decltype(node), Node*>::value, "Node must be of type Node*");

		if (node->hasChildOfType(Type::UNION)) {
			std::cout << "FOUND";
			Node* new_node = new Node(Type::UNION);

			for (auto* child: node->getChildren()) {
				if (child->getType() == Type::UNION) {
					new_node->appendChildren(child->getChildren());
					// delete child; // Check if this is needed
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

