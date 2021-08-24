<?php

namespace Zheltikov\TypeAssert\Parser;

interface Parser
{
    /**
     * Parses PHP code into a node tree.
     *
     * @param string $code The source code to parse
     *
     * @return Node|null Array of statements (or null non-throwing error handler is used and
     *                     the parser was unable to recover from an error).
     */
    public function parse(string $code): ?Node;
}
