<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;
use Tale\Iterator\MapIterator;

/**
 * @coversDefaultClass \Tale\Iterator\MapIterator
 */
class MapIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::map
     * @covers ::current
     */
    public function testConstruct(): void
    {
        $obj = new class {
        };
        $resource = stream_context_create();
        $values = new \ArrayIterator([1, 3.4, 'test', true, [], $obj, null, $resource]);
        $mapper = new MapIterator($values);
        $this->assertSame(
            [1, 3.4, 'test', true, [], $obj, null, $resource],
            iterator_to_array($mapper)
        );

        $mapper = new class($values) extends MapIterator
        {
            public function map()
            {
                return \gettype(parent::map());
            }
        };
        $this->assertSame(
            ['integer', 'double', 'string', 'boolean', 'array', 'object', 'NULL', 'resource'],
            iterator_to_array($mapper)
        );
    }
}
