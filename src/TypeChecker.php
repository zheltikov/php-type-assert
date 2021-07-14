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

        if ($type === 'interfacename') {
            return function ($value): bool {
                return is_($value, 'string') && interface_exists($value);
            };
        }

        if ($type === 'traitname') {
            return function ($value): bool {
                return is_($value, 'string') && trait_exists($value);
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
        if ($type === 'empty') {
            return function ($value): bool {
                return empty($value);
            };
        }

        // Not empty
        if ($type === 'nonempty' || $type === 'notempty') {
            return function ($value): bool {
                return !empty($value);
            };
        }

        // Single character
        if ($type === 'char') {
            return function ($value): bool {
                return is_($value, 'string') && strlen($value) === 1;
            };
        }

        // Stringish
        if ($type === 'Stringish') {
            return function ($value): bool {
                if (is_($value, 'string')) { return true; }

                // TODO: maybe add a check for `PHP_VERSION_ID >= 80000`?
                if (interface_exists('\Stringable')) {
                    if ($value instanceof \Stringable) {
                        return true;
                    }
                }

                if (is_object($value) && method_exists($value, '__toString')) {
                    return true;
                }

                return false;
            };
        }

        // True
        if ($type === 'true') {
            return function ($value): bool {
                return $value === true;
            };
        }

        // False
        if ($type === 'false') {
            return function ($value): bool {
                return $value === false;
            };
        }

        // Class/Interface type
        // TODO: instanceof doesn't work with traits
        if (class_exists($type) || interface_exists($type)) {
            return function ($value) use ($type): bool {
                return $value instanceof $type;
            };
        }

        // positive, negative
        // this
        // classname<_>
        // interfacename<_>
        // traitname<_>
        // varray<_>, vec<_>
        // darray<_, _>, dict<_, _>

        // Vector, ImmVector, Map, ImmMap, Set, ImmSet and Pair
        // Container interfaces

        invariant_violation('Unknown type %s provided.', $type);
    }
}
