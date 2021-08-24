<?php

declare(strict_types=1);

namespace Zheltikov\TypeAssert\Parser;

use PhpYacc\Yacc\Token;
use Tmilos\Lexer\Config\LexerArrayConfig;
use Tmilos\Lexer\Config\TokenDefn;

class Lexer
{
    protected $code;

    /**
     * @var \Tmilos\Lexer\Token[]
     */
    protected $tokens;

    protected $pos;
    protected $line;
    protected $filePos;
    protected $prevCloseTagHasNewline;

    protected $tokenMap;
    protected $dropTokens;
    protected $identifierTokens;

    private $attributeStartLineUsed;
    private $attributeEndLineUsed;
    private $attributeStartTokenPosUsed;
    private $attributeEndTokenPosUsed;
    private $attributeStartFilePosUsed;
    private $attributeEndFilePosUsed;
    private $attributeCommentsUsed;

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

        $defaultAttributes = []; /// ['comments', 'startLine', 'endLine'];
        $usedAttributes = array_fill_keys($options['usedAttributes'] ?? $defaultAttributes, true);

        // Create individual boolean properties to make these checks faster.
        $this->attributeStartLineUsed = isset($usedAttributes['startLine']);
        $this->attributeEndLineUsed = isset($usedAttributes['endLine']);
        $this->attributeStartTokenPosUsed = isset($usedAttributes['startTokenPos']);
        $this->attributeEndTokenPosUsed = isset($usedAttributes['endTokenPos']);
        $this->attributeStartFilePosUsed = isset($usedAttributes['startFilePos']);
        $this->attributeEndFilePosUsed = isset($usedAttributes['endFilePos']);
        $this->attributeCommentsUsed = isset($usedAttributes['comments']);
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

            // FIXME: this string implementation is somewhat limited
            '"([^"]*)"' => Tokens::TOKEN_STRING_DQ(),
            "'([^']*)'" => Tokens::TOKEN_STRING_SQ(),
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
     * @param ErrorHandler|null $errorHandler Error handler to use for lexing errors. Defaults to
     *                                        ErrorHandler\Throwing
     */
    public function startLexing(
        string $code,
        ErrorHandler $errorHandler = null
    ) {
        if (null === $errorHandler) {
            $errorHandler = new ErrorHandler\Throwing();
        }

        $this->code = $code; // keep the code around for __halt_compiler() handling
        $this->pos = -1;
        $this->line = 1;
        $this->filePos = 0;

        // If inline HTML occurs without preceding code, treat it as if it had a leading newline.
        // This ensures proper composability, because having a newline is the "safe" assumption.
        $this->prevCloseTagHasNewline = true;

        /// $scream = ini_set('xdebug.scream', '0');

        $this->tokens = $this->token_get_all($code); /// FIXME: need a real lexer
        // $this->postprocessTokens($errorHandler);

        /// if (false !== $scream) {
        ///     ini_set('xdebug.scream', $scream);
        /// }
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
                throw new \InvalidArgumentException(
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

        return array_map(function (\Tmilos\Lexer\Token $token) use ($valid_tokens): array {
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
                // $token = Tokens::TOKEN_EOF(); // "\0";
                /* $token = [
                    'code' => Tokens::TOKEN_EOF()->getValue(),
                    'name' => 'TOKEN_EOF',
                    'offset' => -1,
                    'position' => -1,
                    'value' => "\0",
                ]; */
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

            if (\is_string($token)) {
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
                /*if (\T_CLOSE_TAG === $token[0]) {
                    $this->prevCloseTagHasNewline = false !== strpos($token[1], "\n")
                                                    || false !== strpos($token[1], "\r");
                } elseif (\T_INLINE_HTML === $token[0]) {
                    $startAttributes['hasLeadingNewline'] = $this->prevCloseTagHasNewline;
                }*/

                $this->line += substr_count($value, "\n");
                $this->filePos += \strlen($value);
            } else {
                $origLine = $this->line;
                $origFilePos = $this->filePos;
                $this->line += substr_count($token['value'], "\n");
                $this->filePos += \strlen($token['value']);

                /*if (\T_COMMENT === $token[0] || \T_DOC_COMMENT === $token[0]) {
                    if ($this->attributeCommentsUsed) {
                        $comment = \T_DOC_COMMENT === $token[0]
                            ? new Comment\Doc(
                                $token[1],
                                $origLine, $origFilePos, $this->pos,
                                $this->line, $this->filePos - 1, $this->pos
                            )
                            : new Comment(
                                $token[1],
                                $origLine, $origFilePos, $this->pos,
                                $this->line, $this->filePos - 1, $this->pos
                            );
                        $startAttributes['comments'][] = $comment;
                    }
                }*/
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
        throw new \RuntimeException('Reached end of lexer loop');
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
