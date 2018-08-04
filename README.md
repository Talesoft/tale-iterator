
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
array(11) {
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
```php
use Tale\Iterator\CallbackMapIterator;

$values = new \ArrayIterator(range(0, 5));

$mapper = new CallbackMapIterator($values, function (int $number) {
    return sprintf('Value %d', $number);
});

var_dump(iterator_to_array($mapper));
/*
array(11) {
  [0] => string(7) "Value 0"
  [1] => string(7) "Value 1"
  [2] => string(7) "Value 2"
  [3] => string(7) "Value 3"
  [4] => string(7) "Value 4"
  [5] => string(7) "Value 5"
}
*/
```

### FormatIterator
```php
use Tale\Iterator\FormatIterator;

$values = new \ArrayIterator(range(0, 5));

$formatter = new FormatIterator($values, 'Value %d');

var_dump(iterator_to_array($formatter));
/*
array(11) {
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
```php
use Tale\Iterator\PrefixIterator;

$values = new \ArrayIterator(range(0, 5));

$prefixer = new PrefixIterator($values, 'Value ');

var_dump(iterator_to_array($prefixer));
/*
array(11) {
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

### FlipIterator
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

Keys won't be overwritten when flipping back on the same iterator

```php
use Tale\Iterator\FlipIterator;

$values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 2]);

$flipper = new FlipIterator($values);

//Do something with $flipper

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
