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

use ChiliLabs\JsonPatch\Operation\CopyOperation;
use ChiliLabs\JsonPatch\Operation\MoveOperation;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class CopyOperationTest extends AbstractOperationTest
{
    public function testOperation()
    {
        $operation = new CopyOperation('/node2', '/new');
        $newDocument = $operation(array('node2' => 'old'), $this->facade);
        $this->assertEquals(array('node2' => 'old', 'new' => 'old'), $newDocument);
    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     */
    public function testOperationWithMissingPath()
    {
        $operation = new CopyOperation('/node2', '/new');
        $operation(array('node' => 'old'), $this->facade);
    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     */
    public function testOperationWithExistingPath()
    {
        $operation = new CopyOperation('/node2', '/new');
        $operation(array('node2' => 'old', 'new' => 'old'), $this->facade);
    }
}
