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

use ChiliLabs\JsonPatch\Operation\ReplaceOperation;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class ReplaceOperationTest extends AbstractOperationTest
{
    public function testOperation()
    {
        $operation = new ReplaceOperation('/node2', 'new');
        $newDocument = $operation(array('node2' => 'old'), $this->facade);
        $this->assertEquals(array('node2' => 'new'), $newDocument);
    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     */
    public function testOperationWithInvalidPath()
    {
        $operation = new ReplaceOperation('/node2', 'new');
        $operation(array('node' => 'old'), $this->facade);
    }
}
