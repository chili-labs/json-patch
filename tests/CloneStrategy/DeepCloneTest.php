<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\Test\CloneStrategy;

use ChiliLabs\JsonPatch\CloneStrategy\DeepCloneStrategy;
use DeepCopy\DeepCopy;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class DeepCloneTest extends \PHPUnit_Framework_TestCase
{
    public function testObject()
    {
        $object = new \stdClass();
        $object->a = 'abc';
        $object->b = new \stdClass();
        $object->b->c = 'test';

        $clone = new DeepCloneStrategy(new DeepCopy());

        $clonedObject = $clone->cloneDocument($object);

        $this->assertNotSame($object, $clonedObject);
        $this->assertSame($object->a, $clonedObject->a);
        $this->assertNotSame($object->b, $clonedObject->b);
    }

    public function testArray()
    {
        $array = array(
            'a' => 'abc',
            'b' => new \stdClass(),
        );
        $array['b']->c = 'test';

        $clone = new DeepCloneStrategy(new DeepCopy());

        $clonedArray = $clone->cloneDocument($array);

        $this->assertNotSame($array, $clonedArray);
        $this->assertSame($array['a'], $clonedArray['a']);
        $this->assertNotSame($array['b'], $clonedArray['b']);

        $array['a'] = 'def';
        $this->assertNotSame($array, $clonedArray);
    }
}
