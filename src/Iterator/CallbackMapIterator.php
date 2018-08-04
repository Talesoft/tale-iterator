<?php
declare(strict_types=1);

namespace Tale\Iterator;

class CallbackMapIterator extends MapIterator
{
    private $callback;

    /**
     * CallbackMapIterator constructor.
     * @param \Traversable $iterator
     * @param callable $callback
     */
    public function __construct(\Traversable $iterator, callable $callback)
    {
        parent::__construct($iterator);
        $this->callback = $callback;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    public function map()
    {
        $callback = $this->callback;
        return $callback(parent::map(), parent::key(), $this);
    }
}