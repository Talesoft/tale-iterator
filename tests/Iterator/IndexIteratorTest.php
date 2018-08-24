<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\FilterIterator;
use Tale\Iterator\IndexIterator;
use Tale\Iterator\MapIterator;
use Tale\Iterator\ValueIterator;

/**
 * @coversDefaultClass \Tale\Iterator\IndexIterator
 */
class IndexIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getIndex
     * @covers ::rewind
     * @covers ::next
     */
    public function testGetIndex(): void
    {
        $indexer = new IndexIterator(new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]));
        $i = 0;
        foreach ($indexer as $key => $value) {
            $this->assertSame($i++, $indexer->getIndex(), "call for {$key} => {$value}");
        }
    }
}
