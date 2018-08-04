<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\FlipIterator;
use Tale\Iterator\FormatIterator;

/**
 * @coversDefaultClass \Tale\Iterator\FormatIterator
 */
class FormatIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getFormat
     * @covers ::map
     */
    public function testConstruct(): void
    {
        $values = new \ArrayIterator(['a', 'b', 'c', 'd', 'e']);
        $formatter = new FormatIterator($values, 'test %s format');
        $this->assertEquals('test %s format', $formatter->getFormat());
        $this->assertSame(
            ['test a format', 'test b format', 'test c format', 'test d format', 'test e format'],
            iterator_to_array($formatter)
        );
    }
}
