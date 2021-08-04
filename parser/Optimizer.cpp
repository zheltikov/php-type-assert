
#pragma once

#include <type_traits>
#include <map>

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
	void dedupeUnions();
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
	//std::cout << "Unoptimized:  " << root->toJson() << "\n";

	std::string serialized;
	auto i = 1;

	while (serialized.compare(root->toJson()) != 0) {
		serialized = root->toJson();

		unwrapUnions();
		dedupeUnions();

		//std::cout << "Intermediate: " << root->toJson() << "\n";
		i++;
	}

	//std::cout << "Optimized:    " << root->toJson() << "\n";
	//std::cout << i << " optimization iterations.\n";
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

void Optimizer::dedupeUnions()
{
	Node* node = root->getFirstByType(Type::UNION);
	if (node != nullptr) {
		static_assert(std::is_same<decltype(node), Node*>::value, "Node must be of type Node*");

		std::map<Type, int> counter;
		bool needs_optimization = false;

		for (auto* child: node->getChildren()) {
			auto child_count = child->getChildren().size();
			if (child_count > 0) { continue; }

			auto type = child->getType();
			if (map_key_exists(counter, type)) {
				counter[type]++;
				needs_optimization = true;
			} else {
				counter[type] = 1;
			}
		}

		if (needs_optimization) {
			std::map<Type, int> just_added;
			Node* new_node = new Node(Type::UNION);
			for (auto* child: node->getChildren()) {
				auto child_count = child->getChildren().size();
				if (child_count > 0) {
					new_node->appendChild(child);
				}

				auto type = child->getType();
				if (map_key_exists(counter, type)) {
					if (!map_key_exists(just_added, type)) {
						new_node->appendChild(child);
						just_added[child->getType()] = 1;
					} else {
						delete child;
					}
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

