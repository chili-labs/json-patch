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

use ChiliLabs\JsonPointer\Access\Accessor\AccessorInterface;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
interface OperationInterface
{
//    const OPERATION_REMOVE = 'remove';
//    const OPERATION_REPLACE = 'replace';
//    const OPERATION_COPY = 'copy';
//    const OPERATION_MOVE = 'move';
//    const OPERATION_TEST = 'test';

    /**
     * @param mixed             $document
     * @param AccessorInterface $accessor
     *
     * @return mixed
     */
    public function __invoke($document, AccessorInterface $accessor);
}
