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

use ChiliLabs\JsonPatch\Copy\SimpleClone;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class SimpleCloneTest extends \PHPUnit_Framework_TestCase
{
    public function testObject()
    {
        $object = new \stdClass();
        $object->a = "abc";
        $object->b = new \stdClass();
        $object->b->c = "test";

        $clone = new SimpleClone();

        $clonedObject = $clone->cloneDocument($object);

        $this->assertNotSame($object, $clonedObject);
        $this->assertSame($object->a, $clonedObject->a);
        $this->assertSame($object->b, $clonedObject->b);
    }

    public function testArray()
    {
        $array = array(
            'a' => "abc",
            'b' => new \stdClass(),
        );
        $array['b']->c = "test";

        $clone = new SimpleClone();

        $clonedArray = $clone->cloneDocument($array);

        $this->assertSame($array, $clonedArray);
        $this->assertSame($array['a'], $clonedArray['a']);
        $this->assertSame($array['b'], $clonedArray['b']);

        $array['a'] = "def";
        $this->assertNotSame($array, $clonedArray);
    }
}
