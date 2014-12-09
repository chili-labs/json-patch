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

use ChiliLabs\JsonPointer\Access\AccessFacade;
use ChiliLabs\JsonPointer\Access\Accessor\ArrayAccessor;
use ChiliLabs\JsonPointer\Access\AccessorFactory;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
abstract class AbstractOperationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AccessFacade
     */
    protected $facade;

    protected function setUp()
    {
        $factory = new AccessorFactory(array(new ArrayAccessor()));
        $this->facade = new AccessFacade($factory);
    }
}
