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

use ChiliLabs\JsonPatch\Copy\CloneInterface;
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
     * @var CloneInterface
     */
    private $clone;

    /**
     * @param AccessFacade   $facade
     * @param CloneInterface $clone
     */
    public function __construct(AccessFacade $facade, CloneInterface $clone)
    {
        $this->facade = $facade;
        $this->clone = $clone;
    }

    /**
     * @param JsonPatch    $patch
     * @param object|array $document
     *
     * @return mixed
     *
     * @throws OperationException
     */
    public function apply(JsonPatch $patch, $document)
    {
        $documentCopy = $this->clone->cloneDocument($document);

        foreach ($patch->getOperations() as $operation) {
            $documentCopy = $operation($documentCopy, $this->facade);
        }

        return $documentCopy;
    }
}
