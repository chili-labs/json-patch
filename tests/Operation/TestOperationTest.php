<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\Test\Access;

use ChiliLabs\JsonPatch\Operation\TestOperation;
use ChiliLabs\JsonPointer\Access\Accessor\ArrayAccessor;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class TestOperationTest extends \PHPUnit_Framework_TestCase
{
    public function testOperation()
    {
        $operation = new TestOperation('/node2', 'value');
        $newDocument = $operation(array('node2' => 'value'), new ArrayAccessor());
        $this->assertEquals(array('node2' => 'value'), $newDocument);
    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     * @expectedExceptionMessage does not exist
     */
    public function testOperationWithInvalidPath()
    {
        $operation = new TestOperation('/node', 'value');
        $operation(array('node2' => 'value'), new ArrayAccessor());
    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     * @expectedExceptionMessage Test failed:
     */
    public function testOperationWithWrongValue()
    {
        $operation = new TestOperation('/node2', 'value2');
        $operation(array('node2' => 'value'), new ArrayAccessor());
    }
}
