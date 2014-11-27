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

use ChiliLabs\JsonPatch\Operation\RemoveOperation;
use ChiliLabs\JsonPointer\Access\Accessor\ArrayAccessor;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class RemoveOperationTest extends \PHPUnit_Framework_TestCase
{
    public function testOperation()
    {
        $operation = new RemoveOperation('/node2');
        $newDocument = $operation(array('node' => 123, 'node2' => 'old'), new ArrayAccessor());
        $this->assertEquals(array('node' => 123), $newDocument);
    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     */
    public function testOperationWithInvalidPath()
    {
        $operation = new RemoveOperation('/node2');
        $operation(array('node' => 'old'), new ArrayAccessor());
    }
}
