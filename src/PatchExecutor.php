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

use ChiliLabs\JsonPatch\Access\AccessorInterface;
use ChiliLabs\JsonPatch\Exception\NoMatchingAccessorException;
use ChiliLabs\JsonPatch\Exception\OperationException;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class PatchExecutor
{
    /**
     * @var AccessorInterface
     */
    private $accessors = array();

    /**
     * @param AccessorInterface[] $accessors
     */
    public function __construct(array $accessors = array())
    {
        $this->accessors = $accessors;
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
        $accessor = $this->findMatchingAccessor($documentCopy);

        foreach ($patch->getOperations() as $operation) {
            $documentCopy = $operation($documentCopy, $accessor);
        }

        return $documentCopy;
    }

    /**
     * @param mixed $document
     *
     * @return AccessorInterface
     */
    private function findMatchingAccessor($document)
    {
        foreach ($this->accessors as $accessor) {
            if ($accessor->supports($document)) {
                return $accessor;
            }
        }

        throw new NoMatchingAccessorException(
            sprintf('Could not find a matching Accessor. No way to access document of type %s.', gettype($document))
        );
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
