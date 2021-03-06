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
class TestOperation extends AbstractPatchOperation
{
    const NAME = 'test';

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
    public function __invoke($document, AccessFacade $access)
    {
        if (!$access->isReadable($document, $this->path)) {
            throw new OperationException(sprintf('The path "%s" does not exist.', (string) $this->path));
        }

        $value = $access->get($document, $this->path);
        if ($value != $this->value) {
            throw new OperationException(sprintf('Test failed: Values do not match (%s != %s).', $value, $this->value));
        }

        return $document;
    }
}
