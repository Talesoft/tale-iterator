<?php
declare(strict_types=1);

namespace Tale\Iterator;

class ValueIterator extends IndexIterator
{
    public function key()
    {
        return $this->getIndex();
    }
}
