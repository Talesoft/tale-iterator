<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\FlipIterator;
use Tale\Iterator\IterableIterator;

/**
 * @coversDefaultClass \Tale\Iterator\IterableIterator
 */
class IterableIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstruct(): void
    {
        $iterator = new IterableIterator(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 3, 'e' => 4]);
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 3, 'e' => 4], iterator_to_array($iterator));

        $iterator = new IterableIterator(new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 3, 'e' => 4]));
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 3, 'e' => 4], iterator_to_array($iterator));
    }
}
