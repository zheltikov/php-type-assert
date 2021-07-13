<?php

namespace Zheltikov\TypeAssert;

use Zheltikov\Exceptions\TypeAssertionException;

/**
 * Checks whether a value has the type specified, and returns a boolean result.
 *
 * @param mixed $value
 * @param string $type
 * @return bool
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function is_(&$value, string $type): bool
{
    $checker = TypeChecker::getCheckerFn($type);
    return $checker($value);
}

/**
 * Performs the same checks as `is_`.
 * However, it throws `TypeAssertionException` if the value has a different
 * type.
 *
 * @param mixed $value
 * @param string $expected
 * @return mixed
 * @throws \Zheltikov\Exceptions\TypeAssertionException
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function as_(&$value, string $expected)
{
    if (!is_($value, $expected)) {
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
 * @return mixed|null
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function null_as_(&$value, string $expected)
{
    try {
        return as_($value, $expected);
    } catch (TypeAssertionException $e) {
    }

    return null;
}
