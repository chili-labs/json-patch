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

use ChiliLabs\JsonPatch\Exception\OperationException;
use ChiliLabs\JsonPointer\Access\AccessFacade;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class RemoveOperation extends AbstractPatchOperation
{
    const NAME = 'remove';

    /**
     * {@inheritdoc}
     */
    public function __invoke($document, AccessFacade $access)
    {
        if (!$access->isWritable($document, $this->path)) {
            throw new OperationException(sprintf('The path "%s" does not exist.', (string) $this->path));
        }

        $access->delete($document, $this->path);

        return $document;
    }
}
