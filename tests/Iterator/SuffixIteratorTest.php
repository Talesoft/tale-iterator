<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\SuffixIterator;

/**
 * @coversDefaultClass \Tale\Iterator\SuffixIterator
 */
class SuffixIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getSuffix
     * @covers ::map
     */
    public function testConstruct(): void
    {
        $values = new \ArrayIterator(['a', 'b', 'c', 'd', 'e']);
        $prefixer = new SuffixIterator($values, ' test');
        $this->assertEquals(' test', $prefixer->getSuffix());
        $this->assertSame(
            ['a test', 'b test', 'c test', 'd test', 'e test'],
            iterator_to_array($prefixer)
        );
    }
}
