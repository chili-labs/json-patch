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
use ChiliLabs\JsonPatch\Operation\CopyOperation;
use ChiliLabs\JsonPatch\Operation\MoveOperation;
use ChiliLabs\JsonPatch\Operation\RemoveOperation;
use ChiliLabs\JsonPatch\Operation\ReplaceOperation;
use ChiliLabs\JsonPatch\Operation\TestOperation;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class JsonPatchTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetOperations()
    {
        $patch = new JsonPatch();
        $this->assertEquals(array(), $patch->getOperations());

        $patch = new JsonPatch(array());
        $this->assertEquals(array(), $patch->getOperations());

        $operations = array(new TestOperation('', ''));
        $patch = new JsonPatch($operations);
        $this->assertSame($operations, $patch->getOperations());
    }

    public function dataProvider()
    {
        return array(
            array(array(new AddOperation('/p', '1')), '[{"op":"add","path":"/p","value":"1"}]'),
            array(array(new AddOperation('/p', '1')), json_decode('[{"op":"add","path":"/p","value":"1"}]', true)),
            array(array(new RemoveOperation('/p')), '[{"op":"remove","path":"/p"}]'),
            array(array(new ReplaceOperation('/p', '1')), '[{"op":"replace","path":"/p","value":"1"}]'),
            array(array(new TestOperation('/p', '1')), '[{"op":"test","path":"/p","value":"1"}]'),
            array(array(new MoveOperation('/p', '/s')), '[{"op":"move","from":"/p","path":"/s"}]'),
            array(array(new CopyOperation('/p', '/s')), '[{"op":"copy","from":"/p","path":"/s"}]'),
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
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage myoperation
     */
    public function testInvalidFromJson()
    {
        $patch = JsonPatch::fromJson('[{"op":"myoperation","from":"/p","path":"/s"}]');
    }
}
