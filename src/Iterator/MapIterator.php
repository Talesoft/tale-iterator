<?php
declare(strict_types=1);

namespace Tale\Iterator;

class MapIterator extends \IteratorIterator
{
    public function map()
    {
        return parent::current();
    }

    public function current()
    {
        return $this->map();
    }
}