<?php
declare(strict_types=1);

namespace Tale\Iterator;

use IteratorIterator;

class FilterIterator extends IteratorIterator
{
    public function accept(): bool
    {
        return !empty(parent::current());
    }

    public function valid(): bool
    {
        while (($valid = parent::valid()) && !$this->accept()) {
            $this->next();
        }
        return $valid;
    }
}
