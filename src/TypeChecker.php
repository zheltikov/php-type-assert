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
        $strlen = strlen($type);

        invariant($strlen, 'Type must not be empty.');

        if ($type === 'bool' || $type === 'boolean') {
            return function ($value): bool {
                return is_bool($value);
            };
        }

        if ($type === 'int' || $type === 'integer' || $type === 'long') {
            return function ($value): bool {
                return is_int($value);
            };
        }

        if ($type === 'float' || $type === 'double' || $type === 'real') {
            return function ($value): bool {
                return is_float($value);
            };
        }

        if ($type === 'string') {
            return function ($value): bool {
                return is_string($value);
            };
        }

        if ($type === 'array') {
            return function ($value): bool {
                return is_array($value);
            };
        }

        if ($type === 'object') {
            return function ($value): bool {
                return is_object($value);
            };
        }

        if ($type === 'callable') {
            return function ($value): bool {
                return is_callable($value);
            };
        }

        if ($type === 'iterable') {
            return function ($value): bool {
                return is_iterable($value);
            };
        }

        if ($type === 'resource') {
            return function ($value): bool {
                return is_resource($value);
            };
        }

        if ($type === 'null') {
            return function ($value): bool {
                return $value === null;
            };
        }

        // A value that is not null
        if ($type === 'nonnull' || $type === 'notnull') {
            return function ($value): bool {
                return $value !== null;
            };
        }

        if ($type === 'countable') {
            return function ($value): bool {
                return is_countable($value);
            };
        }

        if ($type === 'numeric') {
            return function ($value): bool {
                return is_numeric($value);
            };
        }

        if ($type === 'scalar') {
            return function ($value): bool {
                return is_scalar($value);
            };
        }

        // A number: int or float
        if ($type === 'num' || $type === 'number') {
            return function ($value): bool {
                return is_($value, 'int') || is_($value, 'float');
            };
        }

        // Everything
        if ($type === 'mixed' || $type === 'dynamic' || $type === 'any') {
            return function (): bool {
                return true;
            };
        }

        // Noting
        if ($type === 'void' || $type === 'nothing') {
            return function (): bool {
                return false;
            };
        }

        // A valid array key: int or string
        if ($type === 'arraykey') {
            return function ($value): bool {
                return is_($value, 'int') || is_($value, 'string');
            };
        }

        // Nullable type
        if (
            $type[0] === '?'
            && $strlen > 1
        ) {
            $other_type = substr($type, 1);
            return function ($value) use ($other_type): bool {
                return is_($value, 'null') || is_($value, $other_type);
            };
        }

        // Negated type
        if (
            $type[0] === '!'
            && $strlen > 1
        ) {
            $other_type = substr($type, 1);
            return function ($value) use ($other_type): bool {
                return !is_($value, $other_type);
            };
        }

        if ($type === 'classname') {
            return function ($value): bool {
                return is_($value, 'string') && class_exists($value);
            };
        }

        // Tuple
        if (
            $type[0] === '('
            && $strlen > 2
            && $type[$strlen - 1] === ')'
        ) {
            // TODO: divide into type vec, count and check
        }

        // Shape
        if (
            substr($type, 0, strlen('shape(')) === 'shape('
            && $strlen > strlen('shape(') + 1
            && $type[$strlen - 1] === ')'
        ) {
            // TODO: divide into type dict, count and check
            // TODO: check if open/closed
        }

        // Vec or Varray
        if ($type === 'vec' || $type === 'varray') {
            // TODO: ...
        }

        // Dict or Darray
        if ($type === 'dict' || $type === 'darray') {
            // TODO: ...
        }

        // Keyset
        if ($type === 'keyset') {
            // TODO: ...
        }

        // Varray or Darray
        if ($type === 'varray_or_darray') {
            return function ($value): bool {
                return is_($value, 'varray') || is_($value, 'darray');
            };
        }

        // Empty


        // Class/Interface type
        // TODO: instanceof doesn't work with traits
        if (class_exists($type) || interface_exists($type)) {
            return function ($value) use ($type): bool {
                return $value instanceof $type;
            };
        }

        // char
        // positive, negative
        // Stringish = string|Stringable
        // empty
        // notempty, nonempty
        // tuples
        // shapes (by default, closed)
        // open shapes (with ... in the field list)
        // optional shape fields (like `shape(?'my_field' => int)`)
        // Enums
        // Backed Enums
        // this
        // classname<_>
        // varray<_>, vec<_>
        // darray<_, _>, dict<_, _>
        // array<_>, array<_, _>
        // Type unions = int|string|null|DateTime
        // Type intersections = Exception&Throwable

        // Vector, ImmVector, Map, ImmMap, Set, ImmSet and Pair
        // Container interfaces

        invariant_violation('Unknown type %s provided.', $type);
    }
}
