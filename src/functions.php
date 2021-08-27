<?php

namespace Zheltikov\TypeAssert;

use Zheltikov\Exceptions\TypeAssertionException;
use Zheltikov\TypeAssert\TypeCheckerState as State;

/**
 * Checks whether a value has the type specified, and returns a boolean result.
 *
 * @param mixed $value
 * @param string $type
 * @param \Zheltikov\TypeAssert\TypeCheckerState|null $state
 * @return bool
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function is_($value, string $type, ?State &$state = null): bool
{
    if ($state === null) {
        $state = State::create();
    }
    $checker = TypeChecker::getCheckerFn($type);
    return $checker($state, $value);
}

/**
 * Performs the same checks as `is_`.
 * However, it throws `TypeAssertionException` if the value has a different
 * type.
 *
 * @param mixed $value
 * @param string $expected
 * @param \Zheltikov\TypeAssert\TypeCheckerState|null $state
 * @return mixed
 * @throws \Zheltikov\Exceptions\InvariantException
 * @throws \Zheltikov\Exceptions\TypeAssertionException
 */
function as_($value, string $expected, ?State &$state = null)
{
    if (!is_($value, $expected, $state)) {
        // FIXME: gettype may not be as good as we need
        $actual = gettype($value);
        $message = sprintf('Expected %s, got %s', $expected, $actual);
        throw new TypeAssertionException($message);
    }

    return $value;
}

/**
 * Similar to `as_`, but which returns null if the type does not match.
 *
 * @param mixed $value
 * @param string $expected
 * @param \Zheltikov\TypeAssert\TypeCheckerState|null $state
 * @return mixed|null
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function null_as_($value, string $expected, ?State &$state = null)
{
    try {
        return as_($value, $expected, $state);
    } catch (TypeAssertionException $e) {
    }

    return null;
}
