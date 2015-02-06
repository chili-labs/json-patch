<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\Test;

use ChiliLabs\JsonPatch\JsonPatch;
use ChiliLabs\JsonPatch\Operation\AddOperation;
use ChiliLabs\JsonPatch\Operation\RemoveOperation;
use ChiliLabs\JsonPatch\Operation\ReplaceOperation;
use ChiliLabs\JsonPatch\Operation\TestOperation;
use ChiliLabs\JsonPatch\PatchExecutor;
use ChiliLabs\JsonPatch\Test\Access\AbstractOperationTest;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class PatchExecutorTest extends AbstractOperationTest
{

    public function testPatchExecutor()
    {
        $executor = new PatchExecutor($this->facade);
        $document = $executor->apply(new JsonPatch(array(new AddOperation('/123', 1))), array());

        $this->assertEquals(array('123' => 1), $document);

    }

    /**
     * @expectedException \ChiliLabs\JsonPatch\Exception\OperationException
     */
    public function testPatchExecutorWithException()
    {
        $executor = new PatchExecutor($this->facade);
        $executor->apply(new JsonPatch(array(new TestOperation('/123', 1))), array());

    }

    public function dataProvider()
    {
        return array(
            array(array(new AddOperation('/p', '1')), '[{"op":"add","path":"/p","value":"1"}]'),
            array(array(new AddOperation('/p', '1')), json_decode('[{"op":"add","path":"/p","value":"1"}]', true)),
            array(array(new RemoveOperation('/p')), '[{"op":"remove","path":"/p"}]'),
            array(array(new ReplaceOperation('/p', '1')), '[{"op":"replace","path":"/p","value":"1"}]'),
            array(array(new TestOperation('/p', '1')), '[{"op":"test","path":"/p","value":"1"}]'),
        );
    }

    /**
     * @dataProvider dataProvider
     */
    public function testFromJson($expected, $data)
    {
        $patch = JsonPatch::fromJson($data);
        $this->assertEquals($expected, $patch->getOperations());
    }
}
