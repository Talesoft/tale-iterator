<?php
declare(strict_types=1);

namespace Tale\Iterator;

class SuffixIterator extends MapIterator
{
    /**
     * @var string
     */
    private $suffix;

    /**
     * FormatIterator constructor.
     * @param \Traversable $iterator
     * @param string $prefix
     */
    public function __construct(\Traversable $iterator, string $prefix)
    {
        parent::__construct($iterator);
        $this->suffix = $prefix;
    }

    /**
     * @return string
     */
    public function getSuffix(): string
    {
        return $this->suffix;
    }

    public function map()
    {
        return parent::map().$this->suffix;
    }
}