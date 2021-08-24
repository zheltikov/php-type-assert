# php-type-assert

A type checking/assertion library for PHP, for more compact and secure code.

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

// Using `is_()` to check types
is_(1, 'int');        // true
is_('foo', 'int');    // false
is_(1, 'num');        // true
is_(1.5, 'num');      // true
is_('foo', 'num');    // false
is_('mykey', '?arraykey');  // true
is_('bar', '!num');    // true
is_('X', 'char');    // true

// Enforcing types with `as_()`
as_(1, 'int');        // 1
as_('foo', 'int');    // TypeAssertionException
as_(123, '?num');     // 123
as_('bar', '?num');   // TypeAssertionException

// Get `null` if the type does not match with `null_as_()`
null_as_(1, 'int');        // 1
null_as_('foo', 'int');    // null
null_as_(123, '?num');     // 123
null_as_('bar', '?num');   // null

// As you can see performing type checks with these functions is much more
// compact that doing it with `if`s
// For example, instead of...

if (is_int($value) || is_float($value)) {
    // do something
}

// ...use...

if (is_($value, 'num')) {
    // do something
}

// ...or even...

as_($value, 'num');
// do something

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

Performs the same checks as `is_`. However, it throws `TypeAssertionException` if the value has a different type. If the
type matches, it returns the original value.

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
|`'num'`, `'number'`|`is_int()` or `is_float()`|Useful for custom math functions and libraries.|
|`'mixed'`, `'dynamic'`, `'any'`|always `true`||
|`'void'`, `'nothing'`|always `false`||
|`'arraykey'`|`is_int()` or `is_string()`|Useful for checking whether a value is valid for indexing an array.|
|`?<some_other_type>`|`$value === null` or `is_($value, 'some_other_type')`|This is also called "Nullable type".<br />The value can be either `null` or of the type specified after.<br />For example: `?string` refers to either `null` or a `string`.|
|`!<some_other_type>`|when `is_($value, 'some_other_type')` is `false`|This is called a "Negated type".<br />Useful for checking that a value is not of a certain type.<br />For example: `!array` refers to any type except `array`.|
|`<class_or_interface_name>`|`$value instanceof 'class_or_interface_name'`|Useful for checking that a value is an class instance that has a certain member (parent class or interface) in its hierarchy.|
|`'classname'`|`is_string($value)` and `class_exists($value)`|To check whether a given value is a valid class name.|
|`'interfacename'`|`is_string($value)` and `interface_exists($value)`|To check whether a given value is a valid interface name.|
|`'traitname'`|`is_string($value)` and `trait_exists($value)`|To check whether a given value is a valid trait name.|
|`'empty'`|`empty($value)`||
|`'nonempty'`, `'notempty'`|when `empty($value)` is `false`||
|`'char'`|when `is_string()` and `strlen($value) === 1`||
|`'Stringish'`|when `is_string()`, otherwise. see Notes.|This type refers to values that are strings or are string-convertible objects; those that provide the `__toString()` method.<br />For PHP 8.0, a value is also `'Stringish'` if the following is true: `$value instanceof \Stringable`.|
|`'true'`|`$value === true`||
|`'false'`|`$value === false`||
|`'positive'`|`$value > 0`||
|`'nonpositive'`, `'notpositive'`|`$value <= 0`||
|`'negative'`|`$value < 0`||
|`'nonnegative'`, `'notnegative'`|`$value >= 0`||

## TODO

- [X] Support for built-in PHP types
- [X] Support for `null` and `nonnull`
- [X] Support for `empty` and `nonempty`
- [X] Support for `mixed` and `void`
- [X] Support for `num`
- [X] Support for `arraykey`
- [X] Support for nullable types
- [X] Support for negated types
- [X] Support for `classname`, `interfacename` and `traitname`
- [X] Support for `char`
- [X] Support for `Stringish`: any string-like value
- [X] Support for custom classnames
- [X] Support for `true` and `false`
- [X] Support for `positive`, `nonpositive` and `notpositive`
- [X] Support for `negative`, `nonnegative` and `notnegative`
- [X] Support for tuples. For example: `(int, ?DateTime, bool)`
- [X] Support for closed shapes. For example: `shape('id' => int, 'name' => string)`
- [X] Support for open shapes. For example: `shape('id' => int, 'name' => string, ...)`
- [X] Support for optional shape fields. For example: `shape('id' => int, ?'name' => string)`
- [ ] Support for enums:
    - [ ] Check by enum type
    - [ ] Check by enum field name
- [X] Support for array generics
    - [X] By value. For example: `array<User>`
    - [X] By key and value. For example: `array<string, int>`
- [X] Support for unions. For example: `int|string|null`
- [X] Support for intersections. For example: `Exception&Throwable`
- [ ] Modularity, ability to define custom checker functions and types
- [ ] Memoize some checker functions
- [ ] Support for type alias definitions
- [ ] Support for type precedence checking definition
- [ ] Support for comments
- [ ] Support for format strings (like for `sprintf` and `sscanf`)
- [ ] Support for regular expressions
- [ ] Support for named parameters

## Performance

You may ask about the performance impact of this parsing process on the overall request. You will be surprised hearing
that the performance of the parser included in this library is actually pretty good.

Some tests were made, in which the following type string was being parsed:

```
shape(
    'id' => int & positive,
    'name' => string,
    'price' => float & positive,
    'score' => null | (int & positive),
    'description' => string,
    'photo_id' => int & positive,
    'category_id' => int & positive
)
```

This test was performed on PHP v7.4 and PHP v8.0 with JIT compilation enabled, and the result aren't bad at all!:

|ms. taken to parse|PHP v7.4|PHP v8.0 (with JIT)|
|---|---|---|
|type parser checks|5|0.1|
|equivalent checks with `if`s|0.15|0.0001|

Note: these performance tests were made at `commit d9fedd23...`, therefore they may not be accurate for the latest
library version.
