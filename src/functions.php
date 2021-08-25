<?php

namespace Zheltikov\TypeAssert;

use Zheltikov\Exceptions\TypeAssertionException;

/**
 * Checks whether a value has the type specified, and returns a boolean result.
 *
 * @param mixed $value
 * @param string $type
 * @param array $report_stack
 * @return bool
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function is_($value, string $type, array &$report_stack = []): bool
{
    $checker = TypeChecker::getCheckerFn($type, $report_stack);
    return $checker($value);
}

/**
 * Performs the same checks as `is_`.
 * However, it throws `TypeAssertionException` if the value has a different
 * type.
 *
 * @param mixed $value
 * @param string $expected
 * @param array $report_stack
 * @return mixed
 * @throws \Zheltikov\Exceptions\InvariantException
 * @throws \Zheltikov\Exceptions\TypeAssertionException
 */
function as_($value, string $expected, array &$report_stack = [])
{
    if (!is_($value, $expected, $report_stack)) {
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
 * @param array $report_stack
 * @return mixed|null
 * @throws \Zheltikov\Exceptions\InvariantException
 */
function null_as_($value, string $expected, array &$report_stack = [])
{
    try {
        return as_($value, $expected, $report_stack);
    } catch (TypeAssertionException $e) {
    }

    return null;
}
