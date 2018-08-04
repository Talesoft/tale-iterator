<?php
declare(strict_types=1);

namespace Tale\Iterator;

class PrefixIterator extends MapIterator
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * FormatIterator constructor.
     * @param \Traversable $iterator
     * @param string $prefix
     */
    public function __construct(\Traversable $iterator, string $prefix)
    {
        parent::__construct($iterator);
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function map()
    {
        return $this->prefix.parent::map();
    }
}