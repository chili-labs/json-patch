<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\Test\Fixtures;

use ChiliLabs\JsonPatch\Operation\AbstractPatchOperation;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class TestOperation extends AbstractPatchOperation
{
    /**
     * @var string
     */
    private $rand;

    /**
     * @param string $rand
     */
    public function __construct($rand)
    {
        $this->rand = $rand;
    }
    /**
     * {@inheritdoc}
     */
    public function __invoke($document)
    {
        $document['test' . $this->rand] = 'test';

        return $document;
    }

}
