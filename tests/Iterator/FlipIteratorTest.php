<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\FlipIterator;

/**
 * @coversDefaultClass \Tale\Iterator\FlipIterator
 */
class FlipIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::current
     * @covers ::key
     */
    public function testConstruct(): void
    {
        $values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 3, 'e' => 4]);
        $flipper = new FlipIterator($values);
        $reverseFlipper = new FlipIterator($flipper);

        $this->assertSame([1 => 'a', 2 => 'c', 3 => 'd', 4 => 'e'], iterator_to_array($flipper));
        $this->assertSame(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 3, 'e' => 4], iterator_to_array($reverseFlipper));

        $values = new \ArrayIterator(['a' => 1, 'b' => 2, 'c' => 2, 'd' => 2]);

        $flipper = new FlipIterator($values);

//Do something with $flipper

        $reverseFlipper = new FlipIterator($flipper);

        var_dump(iterator_to_array($reverseFlipper));
    }
}
