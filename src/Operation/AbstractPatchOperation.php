<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\Operation;

use ChiliLabs\JsonPointer\JsonPointer;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
abstract class AbstractPatchOperation implements OperationInterface
{
    /**
     * @var JsonPointer
     */
    protected $path;

    /**
     * @param string|JsonPointer $path
     */
    public function __construct($path)
    {
        if (is_string($path)) {
            $path = new JsonPointer($path);
        }

        $this->path = $path;
    }
}
