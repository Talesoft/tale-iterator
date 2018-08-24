<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\FilterIterator;
use Tale\Iterator\KeyIterator;
use Tale\Iterator\MapIterator;
use Tale\Iterator\ValueIterator;

/**
 * @coversDefaultClass \Tale\Iterator\KeyIterator
 */
class KeyIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::key
     * @covers ::current
     */
    public function testCurrent(): void
    {
        $mapper = new KeyIterator(new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]));
        $this->assertSame(
            ['a', 'b', 'c', 'd', 'e'],
            iterator_to_array($mapper)
        );
    }
}
