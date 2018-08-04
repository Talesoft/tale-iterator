<?php
declare(strict_types=1);

namespace Tale\Iterator;

class FlipIterator extends \IteratorIterator
{
    public function current()
    {
        return parent::key();
    }

    public function key()
    {
        return parent::current();
    }
}
