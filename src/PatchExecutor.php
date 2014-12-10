<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch;

use ChiliLabs\JsonPatch\Exception\OperationException;
use ChiliLabs\JsonPointer\Access\AccessFacade;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class PatchExecutor
{
    /**
     * @var AccessFacade
     */
    private $facade;

    /**
     * @param AccessFacade $facade
     */
    public function __construct(AccessFacade $facade)
    {
        $this->facade = $facade;
    }

    /**
     * @param JsonPatch $patch
     * @param mixed     $document
     *
     * @return mixed
     *
     * @throws OperationException
     */
    public function apply(JsonPatch $patch, $document)
    {
        $documentCopy = $this->createCopy($document);

        foreach ($patch->getOperations() as $operation) {
            $documentCopy = $operation($documentCopy, $this->facade);
        }

        return $documentCopy;
    }

    /**
     * Creates a copy of the document so the original document is not altered. This is needed
     * to be conform with RFC 6902: "... if any of them (operations) fail then the whole patch
     * operation should abort ..."
     *
     * @param mixed $document
     *
     * @return mixed
     */
    private function createCopy($document)
    {
        if (is_object($document)) {
            return clone $document;
        }

        return $document;
    }
}
