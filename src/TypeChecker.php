<?php

namespace Zheltikov\TypeAssert;

use function Zheltikov\Invariant\{invariant, invariant_violation};

/**
 * Class TypeChecker
 * @package Zheltikov\Invariant\TypeAssert
 */
final class TypeChecker
{
    private function __construct()
    {
    }

    /**
     * @param string $type
     * @return callable
     * @throws \Zheltikov\Exceptions\InvariantException
     */
    public static function getCheckerFn(string $type): callable
    {
        $type = trim($type);

        invariant(strlen($type), 'Type string must not be empty.');

        if ($type === 'bool' || $type === 'boolean') {
            return function (&$value): bool {
                return is_bool($value);
            };
        }

        if ($type === 'int' || $type === 'integer' || $type === 'long') {
            return function (&$value): bool {
                return is_int($value);
            };
        }

        if ($type === 'float' || $type === 'double' || $type === 'real') {
            return function (&$value): bool {
                return is_float($value);
            };
        }

        if ($type === 'string') {
            return function (&$value): bool {
                return is_string($value);
            };
        }

        if ($type === 'array') {
            return function (&$value): bool {
                return is_array($value);
            };
        }

        if ($type === 'object') {
            return function (&$value): bool {
                return is_object($value);
            };
        }

        if ($type === 'callable') {
            return function (&$value): bool {
                return is_callable($value);
            };
        }

        if ($type === 'iterable') {
            return function (&$value): bool {
                return is_iterable($value);
            };
        }

        if ($type === 'resource') {
            return function (&$value): bool {
                return is_resource($value);
            };
        }

        if ($type === 'null') {
            return function (&$value): bool {
                return $value === null;
            };
        }

        if ($type === 'nonnull') {
            return function (&$value): bool {
                return $value !== null;
            };
        }

        if ($type === 'countable') {
            return function (&$value): bool {
                return is_countable($value);
            };
        }

        if ($type === 'numeric') {
            return function (&$value): bool {
                return is_numeric($value);
            };
        }

        if ($type === 'scalar') {
            return function (&$value): bool {
                return is_scalar($value);
            };
        }

        if ($type === 'num') {
            return function (&$value): bool {
                return is_($value, 'int') || is_($value, 'float');
            };
        }

        if ($type === 'mixed' || $type === 'dynamic') {
            return function (&$value): bool {
                return true;
            };
        }

        if ($type === 'void' || $type === 'nothing') {
            return function (&$value): bool {
                return false;
            };
        }

        if ($type === 'arraykey') {
            return function (&$value): bool {
                return is_($value, 'int') || is_($value, 'string');
            };
        }

        if ($type[0] === '?' && strlen($type) > 1) {
            $other_type = substr($type, 1);
            return function (&$value) use ($other_type): bool {
                return is_($value, 'null') || is_($value, $other_type);
            };
        }

        // enums
        // tuples

        // tuples
        // shapes (by default, closed)
        // open shapes (with ... in the field list)
        // optional shape fields (like `shape(?'my_field' => int)`)
        // Enums
        // Backed Enums
        // this
        // classname, classname<_>
        // varray<_>, vec<_>
        // darray<_, _>, dict<_, _>
        // array<_>, array<_, _>

        // vec, keyset, dict
        // Vector, ImmVector, Map, ImmMap, Set, ImmSet and Pair
        // Container interfaces
        // varray, darray, varray_or_darray and array

        invariant_violation('Unknown type string %s provided.', $type);
    }
}
