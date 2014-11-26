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
use ChiliLabs\JsonPointer\Access\Accessor\AccessorInterface;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class RemoveOperation extends AbstractPatchOperation
{
    const NAME = 'replace';

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param string $path
     * @param mixed  $value
     */
    public function __construct($path, $value)
    {
        parent::__construct($path);
        $this->value = $value;
    }
    /**
     * {@inheritdoc}
     */
    public function __invoke($document, AccessorInterface $accessor)
    {
        if (!$accessor->has($document, $this->path)) {
            throw new OperationException(sprintf('The path "%s" does not exist.', (string) $this->path));
        }

        $accessor->remove($document, $this->path);

        return $document;
    }
}
