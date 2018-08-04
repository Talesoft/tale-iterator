<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\PrefixIterator;

/**
 * @coversDefaultClass \Tale\Iterator\PrefixIterator
 */
class PrefixIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getPrefix
     * @covers ::map
     */
    public function testConstruct(): void
    {
        $values = new \ArrayIterator(['a', 'b', 'c', 'd', 'e']);
        $prefixer = new PrefixIterator($values, 'test ');
        $this->assertEquals('test ', $prefixer->getPrefix());
        $this->assertSame(
            ['test a', 'test b', 'test c', 'test d', 'test e'],
            iterator_to_array($prefixer)
        );
    }
}
