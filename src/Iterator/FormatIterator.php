<?php
declare(strict_types=1);

namespace Tale\Iterator;

class FormatIterator extends MapIterator
{
    /**
     * @var string
     */
    private $format;

    /**
     * FormatIterator constructor.
     * @param \Traversable $iterator
     * @param string $format
     */
    public function __construct(\Traversable $iterator, string $format)
    {
        parent::__construct($iterator);
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    public function map()
    {
        return sprintf($this->format, parent::map());
    }
}
