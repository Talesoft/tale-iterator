<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\FilterIterator;
use Tale\Iterator\MapIterator;
use Tale\Iterator\ValueIterator;

/**
 * @coversDefaultClass \Tale\Iterator\ValueIterator
 */
class ValueIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::key
     */
    public function testKey(): void
    {
        $mapper = new ValueIterator(new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]));
        $this->assertSame(
            [1, 2, 3, 4, 5],
            iterator_to_array($mapper)
        );
    }
}
