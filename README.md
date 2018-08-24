
[![Packagist](https://img.shields.io/packagist/v/talesoft/tale-iterator.svg?style=for-the-badge)](https://packagist.org/packages/talesoft/tale-iterator)
[![License](https://img.shields.io/github/license/Talesoft/tale-iterator.svg?style=for-the-badge)](https://github.com/Talesoft/tale-iterator/blob/master/LICENSE.md)
[![CI](https://img.shields.io/travis/Talesoft/tale-iterator.svg?style=for-the-badge)](https://travis-ci.org/Talesoft/tale-iterator)
[![Coverage](https://img.shields.io/codeclimate/coverage/Talesoft/tale-iterator.svg?style=for-the-badge)](https://codeclimate.com/github/Talesoft/tale-iterator)

Tale Iterator
===========

What is Tale Iterator?
--------------------

Tale Iterator extends the SPL iterators by some more, useful iterators for common use-cases.

Installation
------------

```bash
composer require talesoft/tale-iterator
```

Usage
-----

### MapIterator

Maps values by a `map()`-method. You mostly want to extend it
and override the `map()`-method. 

Stack with `FlipIterator` to map keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\MapIterator;

$values = new \ArrayIterator(range(0, 5));
$mapper = new class($values) extends MapIterator
{
    public function map()
    {
        return sprintf('Value %d', parent::map());
    }
};

var_dump(iterator_to_array($mapper));
/*
array(6) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 3"
  [4] => string(7) "Value 4"
  [5] => string(7) "Value 5"
}
*/
```

### CallbackMapIterator

Maps values by specifying a simple callback.

Stack with `FlipIterator` to map keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\CallbackMapIterator;

$values = new \ArrayIterator(range(0, 5));
$mapper = new CallbackMapIterator($values, function (int $number) {
    return sprintf('Value %d', $number);
});

var_dump(iterator_to_array($mapper));
/*
array(6) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 3"
  [4] => string(7) "Value 4"
  [5] => string(7) "Value 5"
}
*/
```

### FilterIterator

Filters values by an `accept()`-method. You mostly want to extend
it and override the `accept()`-method. **It will preserve keys!**.
If you want to reset the keys, chain a `ValueIterator` as shown below.

Stack with `FlipIterator` to filter keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\FilterIterator;

$values = new \ArrayIterator(range(0, 5));
$filterer = new class($values) extends FilterIterator
{
    public function accept(): bool
    {
        return parent::current() !== 4;
    }
};

var_dump(iterator_to_array($filterer));
/*
array(5) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 3"
  [5] => string(7) "Value 5"
}
*/
```

### CallbackFilterIterator

Filters values by specifying a simple callback.

Stack with `FlipIterator` to filter keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\CallbackFilterIterator;

$values = new \ArrayIterator(range(0, 5));
$filterer = new CallbackFilterIterator($values, function (int $number) {
    return $number !== 3;
});

var_dump(iterator_to_array($filterer));
/*
array(5) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [4] => string(7) "Value 4"
  [5] => string(7) "Value 5"
}
*/
```

> **Note:** 
> 
> PHP already has a FilterIterator and a CallbackFilterIterator, 
but it only accepts instances of \Iterator, which doesn't 
include \IteratorAggregate instances. This one accepts 
instances of \Traversable, which includes all iterables 
except for objects and native arrays (which are covered, 
too, keep reading). It uses the same API as the PHP 
implementation, though!


### IterableIterator

This is a small utility iterator that turns any `iterable` into a valid iterator.
It's equivalent to an [\IteratorIterator](http://php.net/manual/de/class.iteratoriterator.php),
that normalizes the passed iterable to

`$iterable instanceof \Traversable ? $iterable : new \ArrayIterator($iterable)`.

With this iterator, you can pass any kind of iterable, arrays, objects,
generators etc. to an iterator that only accepts \Iterator instances easily.

This is useful for PHPs SPL iterators or other iterator implementations that don't leverage 
`iterable` or `\Traversable` and rely on `\Iterator` only and/or do this for a very good reason

```php
use Tale\Iterator\IterableIterator;

$values = new IterableIterator(['a', 'b', 'c', 'd', 'e']);
$filterer = new \RegexIterator($values, '/[a-c]/');

var_dump(iterator_to_array($filterer));
/*
array(3) {
  [0] => string(7) "a"
  [1] => string(7) "b"
  [2] => string(7) "c"
}
*/
```

### ValueIterator

This is basically `array_values()` for iterators. This is useful
to e.g. reset the keys for `FilterIterator` outputs.

```php
use Tale\Iterator\CallbackFilterIterator;
use Tale\Iterator\ValueIterator;

$values = new \ArrayIterator(range(0, 5));
$filterer = new CallbackFilterIterator($values, function (int $number) {
    return $number !== 3;
});
$resetter = new ValueIterator($filterer);

var_dump(iterator_to_array($resetter));
/*
array(5) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 4"
  [4] => string(7) "Value 5"
}

Compare the output to the CallbackFilterIterator example above
and notice the keys!
*/
```

### KeyIterator

This is basically `array_keys()` for iterators. This is useful
if you want to get a clean list of the inner
iterators keys.

```php
use Tale\Iterator\KeyIterator;

$values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3]);
$keys = new KeyIterator($values);

var_dump(iterator_to_array($keys));
/*
array(3) {
  [0] => string(7) "a"
  [1] => string(7) "b"
  [2] => string(7) "c"
}

Compare the output to the CallbackFilterIterator example above
and notice the keys!
*/
```

### FlipIterator

This iterator will flip keys and values. This is often useful if you want
outer iterators act on keys rather than on values.

Through the way iterators work, as long as you don't flatten the iterator
to an array, duplicate values won't result on dropped keys! Notice the second example
to understand what I mean.

```php
use Tale\Iterator\FlipIterator;

$values = new \ArrayIterator(range('a', 'e'));
$flipper = new FlipIterator($values);

var_dump(iterator_to_array($flipper));
/*
array(5) {
  'a' => int(0)
  'b' => int(1)
  'c' => int(2)
  'd' => int(3)
  'e' => int(4)
}
*/
```

With `array_flip`, duplicate values will lead to dropped keys, as array
keys have to be unique. With iterators, this isn't the case as long as
you don't actually flatten it!

```php
use Tale\Iterator\FlipIterator;

$values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 2]);
$flipper = new FlipIterator($values);

//Do something with $flipper, like, iterator stuff

$reverseFlipper = new FlipIterator($flipper);

var_dump(iterator_to_array($reverseFlipper));
/*
array(4) {
  'a' => int(1)
  'b' => int(2)
  'c' => int(2)
  'd' => int(2)
}
*/
```

### FormatIterator

This is basically `sprintf($format, $current)` on each value in the 
iterator.

Stack with `FlipIterator` to format keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\FormatIterator;

$values = new \ArrayIterator(range(0, 5));
$formatter = new FormatIterator($values, 'Value %d');

var_dump(iterator_to_array($formatter));
/*
array(6) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 3"
  [4] => string(7) "Value 4"
  [5] => string(7) "Value 5"
}
*/
```

### PrefixIterator

This is `$prefix.$current` for each value in the iterator.

Stack with `FlipIterator` to prefix keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\PrefixIterator;

$values = new \ArrayIterator(range(0, 5));
$prefixer = new PrefixIterator($values, 'Value ');

var_dump(iterator_to_array($prefixer));
/*
array(6) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 3"
  [4] => string(7) "Value 4"
  [5] => string(7) "Value 5"
}
*/
```

### SuffixIterator

This is `$current.$suffix` for each value in the iterator.

Stack with `FlipIterator` to suffix keys 
(see "How do I XYZ" at the bottom of this README)

```php
use Tale\Iterator\SuffixIterator;

$values = new \ArrayIterator(range(0, 5));
$suffixer = new SuffixIterator($values, ' Value');

var_dump(iterator_to_array($suffixer));
/*
array(11) {
  [0] => string(7) "0 Value"
  [1] => string(7) "1 Value"
  [2] => string(7) "2 Value"
  [3] => string(7) "3 Value"
  [4] => string(7) "4 Value"
  [5] => string(7) "5 Value"
}
*/
```

### IndexIterator

This iterator counts an independent index during iteration and makes
it available. This is useful to count the amount of iterations, mostly.
`ValueIterator` and `KeyIterator` use this to reset the keys.

```php
use Tale\Iterator\IndexIterator;

$values = new \ArrayIterator(['a' => 'b', 'b' => 'c', 'c' => 'd']);
$indexer = new IndexIterator($values);

foreach ($indexer as $key => $value) {
    $i = $indexer->getIndex();
    echo "{$key} => {$value} - at index: {$i}\n";
}
/*
a => b - at index: 0
b => c - at index: 1
c => d - at index: 2
*/
```



### How to do XYZ?


#### How to map keys instead of values?

Easy, through chaining a MapIterator and FlipIterators! Notice this
doesn't create any additional overhead except for function calls. The internal
array is as no point copied or even modified.

```php
use Tale\Iterator\FlipIterator;
use Tale\Iterator\CallbackMapIterator;

$values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);
$mapper = new FlipIterator(
    new CallbackMapIterator(
        new FlipIterator($values),
        function (string $key) {
            return "Key {$key}";
        }
    )
);

var_dump(iterator_to_array($mapper));
/*
array(4) {
  'Key a' => int(1)
  'Key b' => int(2)
  'Key c' => int(3)
  'Key d' => int(4)
}
*/
```

#### How to filter keys instead of values?

Here, again, the FlipIterator does everything you need!

```php
use Tale\Iterator\FlipIterator;
use Tale\Iterator\CallbackFilterIterator;

$values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4]);
$mapper = new FlipIterator(
    new CallbackFilterIterator(
        new FlipIterator($values),
        function (string $key) {
            return $key !== 'b';
        }
    )
);

var_dump(iterator_to_array($mapper));
/*
array(4) {
  'a' => int(1)
  'c' => int(3)
  'd' => int(4)
}
*/
```