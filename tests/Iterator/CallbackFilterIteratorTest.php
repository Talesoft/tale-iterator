<?php
declare(strict_types=1);

namespace Tale\Test\Stream;

use PHPUnit\Framework\TestCase;
use Tale\Iterator\CallbackFilterIterator;
use Tale\Iterator\FilterIterator;

/**
 * @coversDefaultClass \Tale\Iterator\CallbackFilterIterator
 */
class CallbackFilterIteratorTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getCallback
     * @covers ::accept
     * @covers ::valid
     */
    public function testAccept(): void
    {
        $obj = new class {
        };
        $resource = stream_context_create();
        $values = new \ArrayIterator(['0', 1, false, 3.4, 'test', '', true, [], $obj, null, $resource, '0']);
        $filteredValues = new CallbackFilterIterator($values);
        $this->assertSame(
            [1 => 1, 3 => 3.4, 'test', 6 => true, 8 => $obj, 10 => $resource],
            iterator_to_array($filteredValues)
        );

        $values = new \ArrayIterator(['0', 1, false, 3.4, 'test', '', true, [], $obj, null, $resource, '0']);
        $filter = function ($value) {
            return !\in_array($value, [1, 'test', null], true);
        };
        $filteredValues = new CallbackFilterIterator($values, $filter);
        $this->assertSame($filter, $filteredValues->getCallback());
        $this->assertSame(
            ['0', 2 => false, 3.4, 5 => '', true, [], $obj, 10 => $resource, '0'],
            iterator_to_array($filteredValues)
        );
    }
}
