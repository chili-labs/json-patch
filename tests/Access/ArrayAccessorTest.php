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

use ChiliLabs\JsonPatch\Access\AccessorInterface;
use ChiliLabs\JsonPatch\Access\ArrayAccessor;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class ArrayAccessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AccessorInterface
     */
    private $accessor;

    protected function setUp()
    {
        $this->accessor = new ArrayAccessor();
    }

    public function testSupports()
    {
        $this->assertTrue($this->accessor->supports(array()));
        $this->assertFalse($this->accessor->supports(''));
        $this->assertFalse($this->accessor->supports(123));
        $this->assertFalse($this->accessor->supports(1.2));
        $this->assertFalse($this->accessor->supports(new \stdClass()));
        $this->assertFalse($this->accessor->supports(false));
        $this->assertFalse($this->accessor->supports(true));
        $this->assertFalse($this->accessor->supports(null));
    }
}
