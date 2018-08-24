<?php
declare(strict_types=1);

namespace Tale\Iterator;

use Traversable;

class CallbackFilterIterator extends FilterIterator
{
    private $callback;

    /**
     * CallbackMapIterator constructor.
     * @param Traversable $iterator
     * @param callable $callback
     */
    public function __construct(Traversable $iterator, callable $callback = null)
    {
        parent::__construct($iterator);
        $this->callback = $callback ?? function ($value) {
            return !empty($value);
        };
    }

    /**k
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    public function accept(): bool
    {
        $callback = $this->callback;
        return $callback(parent::current(), parent::key(), $this);
    }
}
