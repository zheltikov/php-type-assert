<?php

namespace Zheltikov\TypeAssert;

use Zheltikov\TypeAssert\StateMessage as Message;

use function Zheltikov\Invariant\invariant;

class TypeCheckerState
{
    /**
     * @var string[][]
     */
    protected array $report_stack;

    /**
     * @var bool
     */
    protected bool $reporting_enabled;

    /**
     * @var int
     */
    protected int $frame;

    /**
     * @var callable[]
     */
    protected array $message_processors;

    /**
     *
     */
    private function __construct()
    {
        $this->report_stack = [[]];
        $this->frame = 0;
        $this->message_processors = [];
        $this->setReportingEnabled();
    }

    // -------------------------------------------------------------------------

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    // -------------------------------------------------------------------------

    /**
     * @param \Zheltikov\TypeAssert\StateMessage $message
     * @param mixed ...$args
     * @return $this
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    public function appendReportStack(Message $message, ...$args): self
    {
        if ($this->isReportingEnabled()) {
            $this->report_stack[$this->frame][] = $this->messageToString($message, ...$args);
        }
        return $this;
    }

    /**
     * @param \Zheltikov\TypeAssert\StateMessage $message
     * @param mixed ...$args
     * @return string
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    public function messageToString(Message $message, ...$args): string
    {
        $processors = array_merge(
            $this->getDefaultMessageProcessors(),
            $this->getUserDefinedMessageProcessors(),
        );
        $message_key = $message->getKey();

        invariant(
            array_key_exists($message_key, $processors),
            'A message processor must exist for %s',
            $message_key,
        );

        $processor = $processors[$message_key];

        invariant(
            is_callable($processor),
            'Processor for message %s must be a callable',
            $message_key
        );

        return (string) call_user_func($processor, ...$args);
    }

    /**
     * @return callable[]
     */
    public function getUserDefinedMessageProcessors(): array
    {
        return $this->message_processors;
    }

    /**
     * @param \Zheltikov\TypeAssert\StateMessage $message
     * @param callable $processor
     * @return $this
     */
    public function setMessageProcessor(Message $message, callable $processor): self
    {
        $this->message_processors[$message->getKey()] = $processor;
        return $this;
    }

    /**
     * @param array $processors
     * @return $this
     */
    public function setMessageProcessors(array $processors): self
    {
        foreach ($processors as $message => $processor) {
            $this->setMessageProcessor($message, $processor);
        }
        return $this;
    }

    /**
     * @param \Zheltikov\TypeAssert\StateMessage $message
     * @return callable|null
     */
    public function unsetMessageProcessor(Message $message): ?callable
    {
        if (!array_key_exists($message->getKey(), $this->message_processors)) {
            return null;
        }

        $processor = $this->message_processors[$message->getKey()];
        unset($this->message_processors[$message->getKey()]);
        return $processor;
    }

    /**
     * @return array|callable[]
     */
    public function resetMessageProcessors(): array
    {
        $x = $this->message_processors;
        $this->message_processors = [];
        return $x;
    }

    /**
     * @return callable[]
     */
    public function getDefaultMessageProcessors(): array
    {
        return [
            Message::UNION_MISMATCH()->getKey() => fn() => 'Value does not match any of the Union types',
            Message::INTERSECTION_MISMATCH()->getKey() => fn() => 'Value does not satisfy Intersection type',
            Message::NOT_ARRAY()->getKey() => fn() => 'Value is not an array',

            Message::TUPLE_WRONG_LENGTH()->getKey() => fn($actual, $expected) => sprintf(
                'Tuple has wrong length %d, expected %d',
                $actual,
                $expected
            ),

            Message::TUPLE_INVALID_KEY()->getKey() => fn($key) => sprintf('Tuple has an invalid key %s', $key),
            Message::TUPLE_INVALID_CHILD()->getKey() => fn($i) => sprintf('Tuple has invalid child at index %d', $i),

            Message::SHAPE_WRONG_LENGTH()->getKey() => fn($actual, $expected) => sprintf(
                'Shape has wrong length %d, expected %d',
                $actual,
                $expected
            ),

            Message::OPEN_SHAPE_WRONG_LENGTH()->getKey() => fn($actual, $expected) => sprintf(
                'Open Shape has wrong length %d, expected less than %d',
                $actual,
                $expected
            ),

            Message::SHAPE_REQUIRED_KEY()->getKey() => fn($key) => sprintf('Required shape key %s is not set', $key),
            Message::SHAPE_WRONG_VALUE()->getKey() => fn($key) => sprintf('Shape has invalid value at key %s', $key),

            Message::OPTIONAL_SHAPE_WRONG_LENGTH()->getKey() => fn($actual, $expected_min, $expected_max) => sprintf(
                'Shape has wrong length %d, expected %d <= length <= %d',
                $actual,
                $expected_min,
                $expected_max
            ),

            Message::OPEN_OPTIONAL_SHAPE_WRONG_LENGTH()->getKey() => fn($actual, $expected_max) => sprintf(
                'Shape has wrong length %d, expected at most %d',
                $actual,
                $expected_max
            ),

            Message::SHAPE_INVALID_KEY()->getKey() => fn($key) => sprintf(
                'Shape has invalid key %s',
                $key
            ),

            Message::EXPECTED_BOOL()->getKey() => fn() => 'Value expected to be bool',
            Message::EXPECTED_INT()->getKey() => fn() => 'Value expected to be int',
            Message::EXPECTED_FLOAT()->getKey() => fn() => 'Value expected to be float',
            Message::EXPECTED_STRING()->getKey() => fn() => 'Value expected to be string',
            Message::EXPECTED_ARRAY()->getKey() => fn() => 'Value expected to be array',
            Message::EXPECTED_OBJECT()->getKey() => fn() => 'Value expected to be object',
            Message::EXPECTED_CALLABLE()->getKey() => fn() => 'Value expected to be callable',
            Message::EXPECTED_ITERABLE()->getKey() => fn() => 'Value expected to be iterable',
            Message::EXPECTED_RESOURCE()->getKey() => fn() => 'Value expected to be resource',
            Message::EXPECTED_NULL()->getKey() => fn() => 'Value expected to be null',
            Message::EXPECTED_SCALAR()->getKey() => fn() => 'Value expected to be scalar',
            Message::EXPECTED_EMPTY()->getKey() => fn() => 'Value expected to be empty',
            Message::EXPECTED_TRUE()->getKey() => fn() => 'Value expected to be true',
            Message::EXPECTED_FALSE()->getKey() => fn() => 'Value expected to be false',
            Message::EXPECTED_POSITIVE()->getKey() => fn() => 'Value expected to be positive',
            Message::EXPECTED_NEGATIVE()->getKey() => fn() => 'Value expected to be negative',

            Message::ARRAY_INVALID_INDEX_CHILD()->getKey() => fn($i) => sprintf(
                'Array has invalid child at index %d',
                $i
            ),

            Message::ARRAY_INVALID_KEY_CHILD()->getKey() => fn($key) => sprintf(
                'Array has invalid child at key %s',
                $key
            ),

            Message::ARRAY_INVALID_KEY()->getKey() => fn($key) => sprintf('Array has invalid key %s', $key),

            Message::NEGATED_MISMATCH()->getKey() => fn() => 'Value negated type mismatch',
            Message::NOT_INSTANCEOF()->getKey() => fn($type) => sprintf('Value is not instanceof %s', $type),
            Message::NOT_VOID()->getKey() => fn() => 'Value cannot ever be void :)',

            Message::MATCH_STRING()->getKey() => fn($str) => sprintf(
                'Value expected to be exactly the string %s',
                $str
            ),

            Message::MATCH_INT()->getKey() => fn($i) => sprintf(
                'Value expected to be exactly the int %d',
                $i
            ),

            Message::MATCH_FLOAT()->getKey() => fn($f) => sprintf(
                'Value expected to be exactly the float %f',
                $f
            ),

            Message::MATCH_REGEX()->getKey() => fn($re) => sprintf(
                'Value expected to match the regex %s',
                $re
            ),

            Message::MATCH_FORMAT()->getKey() => fn($fmt) => sprintf(
                'Value expected to match the format %s',
                $fmt
            ),

            Message::EXPECTED_MATCH_PLACEHOLDER()->getKey() => fn($index) => sprintf(
                'Value\'s placeholder %d expected to match',
                $index
            ),

            Message::NON_MATCHING_PLACEHOLDERS()->getKey() => fn($n) => sprintf(
                'Value has %d non-matching placeholders',
                $n
            ),

            Message::NOT_NUMERIC()->getKey() => fn() => 'Value expected to be numeric',
            Message::NOT_INTABLE()->getKey() => fn() => 'Value expected to be intable',
        ];
    }

    /**
     * @param string|null $message
     * @return $this
     */
    public function shiftReportStack(?string &$message = null): self
    {
        if ($this->isReportingEnabled()) {
            $message = array_pop($this->report_stack[$this->frame]);
        }
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReportStack(): array
    {
        $stack = [];

        foreach ($this->report_stack as $frame) {
            foreach ($frame as $message) {
                $stack[] = $message;
            }
        }

        return $stack;
    }

    /**
     * @param bool $reporting_enabled
     * @return $this
     */
    public function setReportingEnabled(bool $reporting_enabled = true): self
    {
        $this->reporting_enabled = $reporting_enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReportingEnabled(): bool
    {
        return $this->reporting_enabled;
    }

    /**
     * @return $this
     */
    public function pushFrame(): self
    {
        if ($this->isReportingEnabled()) {
            $this->frame++;
            $this->report_stack[$this->frame] = [];
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function popFrame(): self
    {
        if ($this->isReportingEnabled()) {
            if ($this->frame > 0) {
                unset($this->report_stack[$this->frame]);
                $this->frame--;
            } else {
                $this->frame = 0;
                $this->report_stack = [[]];
            }
        }
        return $this;
    }
}
