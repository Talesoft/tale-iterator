<?php
declare(strict_types=1);

namespace Tale\Iterator;

use ArrayIterator;
use IteratorIterator;
use Traversable;

class IterableIterator extends IteratorIterator
{
    public function __construct(iterable $iterable)
    {
        parent::__construct($iterable instanceof Traversable ? $iterable : new ArrayIterator($iterable));
    }
}
