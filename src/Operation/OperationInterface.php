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

use ChiliLabs\JsonPointer\Access\AccessFacade;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
interface OperationInterface
{
    /**
     * @param mixed        $document
     * @param AccessFacade $access
     *
     * @return mixed
     */
    public function __invoke($document, AccessFacade $access);
}
