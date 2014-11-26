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

use ChiliLabs\JsonPatch\Operation\AddOperation;
use ChiliLabs\JsonPointer\Access\Accessor\ArrayAccessor;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class AddOperationTest extends \PHPUnit_Framework_TestCase
{
    public function testOperation()
    {
        $operation = new AddOperation('/node2', 'new');

        $newDocument = $operation(array('node' => 'old'), new ArrayAccessor());

        $this->assertEquals(array('node' => 'old', 'node2' => 'new'), $newDocument);
    }
}
