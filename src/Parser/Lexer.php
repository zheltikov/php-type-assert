<?php

namespace Zheltikov\TypeAssert\Parser;

use InvalidArgumentException;
use RuntimeException;
use Tmilos\Lexer\Config\LexerArrayConfig;
use Tmilos\Lexer\Config\TokenDefn;
use Tmilos\Lexer\Token;

class Lexer
{
    /**
     * @var \Tmilos\Lexer\Token[]
     */
    protected array $tokens;

    protected int $pos;
    protected int $line;
    protected int $filePos;

    protected array $dropTokens;

    private bool $attributeStartLineUsed;
    private bool $attributeEndLineUsed;
    private bool $attributeStartTokenPosUsed;
    private bool $attributeEndTokenPosUsed;
    private bool $attributeStartFilePosUsed;
    private bool $attributeEndFilePosUsed;

    /**
     * Creates a Lexer.
     *
     * @param array $options Options array. Currently only the 'usedAttributes' option is supported,
     *                       which is an array of attributes to add to the AST nodes. Possible
     *                       attributes are: 'comments', 'startLine', 'endLine', 'startTokenPos',
     *                       'endTokenPos', 'startFilePos', 'endFilePos'. The option defaults to the
     *                       first three. For more info see getNextToken() docs.
     */
    public function __construct(array $options = [])
    {
        // map of tokens to drop while lexing (the map is only used for isset lookup,
        // that's why the value is simply set to 1; the value is never actually used.)
        $this->dropTokens = array_fill_keys(
            [Tokens::TOKEN_WHITESPACE()->getKey()],
            1
        );

        $defaultAttributes = [];
        $usedAttributes = array_fill_keys($options['usedAttributes'] ?? $defaultAttributes, true);

        // Create individual boolean properties to make these checks faster.
        $this->attributeStartLineUsed = isset($usedAttributes['startLine']);
        $this->attributeEndLineUsed = isset($usedAttributes['endLine']);
        $this->attributeStartTokenPosUsed = isset($usedAttributes['startTokenPos']);
        $this->attributeEndTokenPosUsed = isset($usedAttributes['endTokenPos']);
        $this->attributeStartFilePosUsed = isset($usedAttributes['startFilePos']);
        $this->attributeEndFilePosUsed = isset($usedAttributes['endFilePos']);
    }

    /**
     * @return array
     */
    public static function getTokenDefinitions(): array
    {
        return array_merge(
            [
                '[ \n\r\t]+' => Tokens::TOKEN_WHITESPACE(),
            ],
            static::getTypeTokenDefinitions(),
            static::getSymbolTokenDefinitions(),
        );
    }

    /**
     * @return array
     */
    public static function getTypeTokenDefinitions(): array
    {
        return array_merge(
            [

                'arraykey' => Tokens::TYPE_ARRAYKEY(),
            ],
            static::getBuiltInTypeTokenDefinitions(),
            static::getCustomTokenDefinitions(),
            [
                'regex' => Tokens::TOKEN_REGEX_STR_PREFIX(),
                '[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*' => Tokens::TYPE_USER_DEFINED(),
            ]
        );
    }

    /**
     * @return array
     */
    public static function getSymbolTokenDefinitions(): array
    {
        return [
            '\?' => Tokens::PREFIX_NULLABLE(),
            '!' => Tokens::PREFIX_NEGATED(),
            '\(' => Tokens::PAREN_LEFT(),
            '\)' => Tokens::PAREN_RIGHT(),
            ',' => Tokens::TOKEN_COMMA(),
            '=>' => Tokens::TOKEN_ARROW(),
            '\|' => Tokens::TOKEN_UNION(),
            '&' => Tokens::TOKEN_INTERSECTION(),
            '\\\\' => Tokens::TOKEN_NS_SEPARATOR(),
            '\.\.\.' => Tokens::TOKEN_ELLIPSIS(),
            '<' => Tokens::TOKEN_ANGLE_LEFT(),
            '>' => Tokens::TOKEN_ANGLE_RIGHT(),
            '/\*' => Tokens::TOKEN_COMMENT_START(),
            '\*/' => Tokens::TOKEN_COMMENT_END(),

            // FIXME: this string implementation is somewhat limited
            '"([^"]*)"' => Tokens::TOKEN_STRING_DQ(),
            "'([^']*)'" => Tokens::TOKEN_STRING_SQ(),

            '[-+]?([0-9]+[.][0-9]*)|([0-9]*[.][0-9]+)' => Tokens::TOKEN_RAW_FLOAT(),
            '[-+]?\d+' => Tokens::TOKEN_RAW_INTEGER(),
        ];
    }

    /**
     * @return array
     */
    public static function getBuiltInTypeTokenDefinitions(): array
    {
        return [
            'bool|boolean' => Tokens::TYPE_BOOL(),
            'int|integer|long' => Tokens::TYPE_INT(),
            'float|double|real' => Tokens::TYPE_FLOAT(),
            'string' => Tokens::TYPE_STRING(),
            'array' => Tokens::TYPE_ARRAY(),
            'object' => Tokens::TYPE_OBJECT(),
            'callable' => Tokens::TYPE_CALLABLE(),
            'iterable' => Tokens::TYPE_ITERABLE(),
            'resource' => Tokens::TYPE_RESOURCE(),
            'null' => Tokens::TYPE_NULL(),
        ];
    }

    /**
     * @return array
     */
    public static function getCustomTokenDefinitions(): array
    {
        $not = 'no(?:n|t)';
        return [
            $not . 'null' => Tokens::TYPE_NOT_NULL(),
            'countable' => Tokens::TYPE_COUNTABLE(),
            'numeric' => Tokens::TYPE_NUMERIC(),
            'scalar' => Tokens::TYPE_SCALAR(),
            'num(?:ber)?' => Tokens::TYPE_NUMBER(),
            'mixed|dynamic|any' => Tokens::TYPE_MIXED(),
            'void|nothing' => Tokens::TYPE_VOID(),
            'classname' => Tokens::TYPE_CLASSNAME(),
            'interfacename' => Tokens::TYPE_INTERFACENAME(),
            'traitname' => Tokens::TYPE_TRAITNAME(),
            'shape' => Tokens::TYPE_SHAPE(),
            'vec|varray' => Tokens::TYPE_VEC(),
            'dict|darray' => Tokens::TYPE_DICT(),
            'keyset' => Tokens::TYPE_KEYSET(),
            'varray_or_darray|vec_or_dict' => Tokens::TYPE_VEC_OR_DICT(),
            'empty' => Tokens::TYPE_EMPTY(),
            $not . 'empty' => Tokens::TYPE_NOT_EMPTY(),
            'char' => Tokens::TYPE_CHAR(),
            'Stringish' => Tokens::TYPE_STRINGISH(),
            'true' => Tokens::TYPE_TRUE(),
            'false' => Tokens::TYPE_FALSE(),
            'positive' => Tokens::TYPE_POSITIVE(),
            $not . 'positive' => Tokens::TYPE_NOT_POSITIVE(),
            'negative' => Tokens::TYPE_NEGATIVE(),
            $not . 'negative' => Tokens::TYPE_NOT_NEGATIVE(),
            'tuple' => Tokens::TYPE_TUPLE(),
            '_' => Tokens::TYPE_PLACEHOLDER(),
        ];
    }

    /**
     * Initializes the lexer for lexing the provided source code.
     *
     * This function does not throw if lexing errors occur. Instead, errors may be retrieved using
     * the getErrors() method.
     *
     * @param string $code The source code to lex
     */
    public function startLexing(
        string $code
    ) {
        $this->pos = -1;
        $this->line = 1;
        $this->filePos = 0;

        $this->tokens = $this->token_get_all($code);
        //var_dump($this->tokens);
        $this->postprocessTokens();
    }

    protected function postprocessTokens(): void
    {
        $tokens = [];
        $comment_stack = 0;

        foreach ($this->tokens as $token) {
            if ($token['name'] === Tokens::TOKEN_COMMENT_START()->getKey()) {
                $comment_stack++;
                continue;
            }

            if ($token['name'] === Tokens::TOKEN_COMMENT_END()->getKey()) {
                $comment_stack--;
                continue;
            }

            if ($comment_stack === 0) {
                $tokens[] = $token;
            }
        }

        $this->tokens = $tokens;
    }

    /**
     * @param string $code
     * @return array
     */
    protected function token_get_all(
        string $code
    ): array {
        $defs = [];
        /** @var \Zheltikov\TypeAssert\Parser\Tokens $token */
        foreach (static::getTokenDefinitions() as $regex => $token) {
            if ($token instanceof TokenDefn) {
                $defs[] = $token;
            } elseif (is_string($regex) && $token instanceof Tokens) {
                $defs['(?:' . $regex . ')'] = $token->getKey();
            } else {
                throw new InvalidArgumentException(
                    sprintf(
                        'Invalid token definition: %s => %s',
                        var_export($regex, true),
                        var_export($token, true),
                    )
                );
            }
        }
        $config = new LexerArrayConfig($defs);

        $tokens = \Tmilos\Lexer\Lexer::scan($config, $code);

        $valid_tokens = Tokens::values();

        return array_map(function (Token $token) use ($valid_tokens): array {
            return [
                'code' => $valid_tokens[$token->getName()]->getValue(),
                'name' => $token->getName(),
                'offset' => $token->getOffset(),
                'position' => $token->getPosition(),
                'value' => $token->getValue(),
            ];
        }, $tokens);
    }

    /**
     * Fetches the next token.
     *
     * The available attributes are determined by the 'usedAttributes' option, which can
     * be specified in the constructor. The following attributes are supported:
     *
     *  * 'comments'      => Array of PhpParser\Comment or PhpParser\Comment\Doc instances,
     *                       representing all comments that occurred between the previous
     *                       non-discarded token and the current one.
     *  * 'startLine'     => Line in which the node starts.
     *  * 'endLine'       => Line in which the node ends.
     *  * 'startTokenPos' => Offset into the token array of the first token in the node.
     *  * 'endTokenPos'   => Offset into the token array of the last token in the node.
     *  * 'startFilePos'  => Offset into the code string of the first character that is part of the node.
     *  * 'endFilePos'    => Offset into the code string of the last character that is part of the node.
     *
     * @param mixed $value Variable to store token content in
     * @param mixed $startAttributes Variable to store start attributes in
     * @param mixed $endAttributes Variable to store end attributes in
     *
     * @return int Token id
     */
    public function getNextToken(
        &$value = null,
        &$startAttributes = null,
        &$endAttributes = null
    ): int {
        $startAttributes = [];
        $endAttributes = [];

        while (1) {
            if (isset($this->tokens[++$this->pos])) {
                $token = $this->tokens[$this->pos];
            } else {
                // EOF token with ID 0
                $token = "\0";
            }

            if ($this->attributeStartLineUsed) {
                $startAttributes['startLine'] = $this->line;
            }
            if ($this->attributeStartTokenPosUsed) {
                $startAttributes['startTokenPos'] = $this->pos;
            }
            if ($this->attributeStartFilePosUsed) {
                $startAttributes['startFilePos'] = $this->filePos;
            }

            if (is_string($token)) {
                $value = $token;
                if (isset($token[1])) {
                    // bug in token_get_all
                    $this->filePos += 2;
                    $id = ord('"');
                } else {
                    $this->filePos += 1;
                    $id = ord($token);
                }
            } elseif (!isset($this->dropTokens[$token['name']])) {
                $value = $token['value'];
                $id = $token['code'];

                $this->line += substr_count($value, "\n");
                $this->filePos += strlen($value);
            } else {
                $this->line += substr_count($token['value'], "\n");
                $this->filePos += strlen($token['value']);

                continue;
            }

            if ($this->attributeEndLineUsed) {
                $endAttributes['endLine'] = $this->line;
            }
            if ($this->attributeEndTokenPosUsed) {
                $endAttributes['endTokenPos'] = $this->pos;
            }
            if ($this->attributeEndFilePosUsed) {
                $endAttributes['endFilePos'] = $this->filePos - 1;
            }

            return $id;
        }

        // This should never occur! :)
        throw new RuntimeException('Reached end of lexer loop');
    }

    /**
     * Returns the token array for current code.
     *
     * The token array is in the same format as provided by the
     * token_get_all() function and does not discard tokens (i.e.
     * whitespace and comments are included). The token position
     * attributes are against this token array.
     *
     * @return \Tmilos\Lexer\Token[] Array of tokens in token_get_all() format
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }
}
