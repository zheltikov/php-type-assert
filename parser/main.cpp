
#include <string>
#include <iostream>
#include <fstream>
#include <functional>

void yyerror(std::string str)
{
	std::cerr << str << "\n";
}

char* cursor;

#include "Node.cpp"

std::variant<Node*, std::nullptr_t> ast = nullptr;

int yylex();
void yyerror(std::string);

#include "parser.cpp"
#include "Optimizer.cpp"

int main(int argc, char** argv)
{
	std::string filename = argv[1];
	//std::cout << "Filename: " << filename << "\n";

	std::ifstream f(filename);
	std::string buffer(std::istreambuf_iterator<char>(f), {});

	// std::cout << "Buffer: " << buffer << "\n";

	// cursor = buffer.c_str();
	cursor = const_cast<char*>(buffer.c_str());

	yyparse();

	auto optimizer = new Optimizer();
	optimizer->setRoot(*std::get<Node*>(ast))
		->execute();
	*std::get<Node*>(ast) = optimizer->getRoot();

	std::string json = std::get<Node*>(ast)->toJson();
	std::cout << json << "\n";

	return 0;
}
