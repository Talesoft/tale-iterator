<?php
declare(strict_types=1);

namespace Tale\Iterator;

class KeyIterator extends IndexIterator
{
    public function key()
    {
        return $this->getIndex();
    }

    public function current()
    {
        return parent::key();
    }
}
