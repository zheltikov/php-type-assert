# php-type-assert

A type checking/assertion library for PHP.

## Installation

As this is a Composer package, you can install it via:

```shell
$ composer require zheltikov/php-type-assert
```

## Usage

This library exposes three functions in the `\Zheltikov\TypeAssert` namespace:

- `is_(mixed, string): bool`
- `as_(mixed, string): mixed`
- `null_as_(mixed, string): mixed|null`

### Example

You may use these functions as follows:

```php
<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Zheltikov\TypeAssert\{is_, as_, null_as_};

// TODO: ...

```

Below comes a simple explanation for each function:

### `is_(mixed, string): bool`

Parameters:
- `mixed $value`
- `string $type`

Checks whether the value in `$value` has the type specified in `$type`, and returns a boolean result.

### `as_(mixed, string): mixed`

Parameters:
- `mixed $value`
- `string $expected`

Performs the same checks as `is_`.
However, it throws `TypeAssertionException` if the value has a different type.
If the type matches, it returns the original value.

### `null_as_(mixed, string): mixed|null`

Parameters:
- `mixed $value`
- `string $expected`

Similar to `as_`, but which returns null if the type does not match.

## Supported types and type interpretation

Here comes a list of the supported types and how they are checked internally:

|Type|Checked with|Notes|
|---|---|---|
|`'bool'`, `'boolean'`|`is_bool()`||
|`'int'`, `'integer'`, `'long'`|`is_int()`||
|`'float'`, `'double'`, `'real'`|`is_float()`||
|`'string'`|`is_string()`||
|`array`|`is_array()`||
|`object`|`is_object()`||
|`callable`|`is_callable()`||
|`iterable`|`is_iterable()`||
|`'resource'`|`is_resource()`||
|`'null'`|`$value === null`||
|`'nonnull'`, `'notnull'`|`$value !== null`||
|`'countable'`|`is_countable()`||
|`'numeric'`|`is_numeric()`||
|`'scalar'`|`is_scalar()`||
|`'num'`|`is_int()` or `is_float()`|Useful for custom math functions and libraries.|
|`'mixed'`, `'dynamic'`|always `true`||
|`'void'`, `'nothing'`|always `false`||
|`'arraykey'`|`is_int()` or `is_string()`|Useful for checking whether a value is valid for indexing an array.|
|`?<some_other_type>`|`$value === null` or `is_($value, 'some_other_type')`|This is also called "Nullable type".<br />The value can be either `null` or of the type specified after.<br />For example: `?string` refers to either `null` or a `string`.|
|`!<some_other_type>`|when `is_($value, 'some_other_type')` is `false`|This is called a "Negated type".<br />Useful for checking that a value is not of a certain type.<br />For example: `!array` refers to any type except `array`.|
|`<class_or_interface_name>`|`$value instanceof 'class_or_interface_name'`|Useful for checking that a value is an class instance that has a certain member (parent class or interface) in its hierarchy.|

## TODO

- [X] Support for built-in PHP types
- [X] Support for some useful types
- [ ] ...
