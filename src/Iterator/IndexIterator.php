<?php
declare(strict_types=1);

namespace Tale\Iterator;

use IteratorIterator;

class IndexIterator extends IteratorIterator
{
    private $index = 0;

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    public function rewind(): void
    {
        parent::rewind();
        $this->index = 0;
    }

    public function next(): void
    {
        parent::next();
        $this->index++;
    }
}
