<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackMapIterator;

/**
 * @coversDefaultClass \Tale\Iterator\CallbackMapIterator
 */
class CallbackMapIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getCallback
     * @covers ::map
     */
    public function testMap(): void
    {
        $values = new \ArrayIterator([1, 3.4, 'test', true, [], new class {
        }, null, stream_context_create()]);
        $callback = function ($value) {
            return \gettype($value);
        };
        $mapper = new CallbackMapIterator($values, $callback);
        $this->assertSame($callback, $mapper->getCallback());
        $this->assertSame(
            ['integer', 'double', 'string', 'boolean', 'array', 'object', 'NULL', 'resource'],
            iterator_to_array($mapper)
        );
    }
}
