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
use ChiliLabs\JsonPointer\JsonPointer;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class MoveOperation extends AbstractPatchOperation
{
    const NAME = 'move';

    /**
     * @var string
     */
    private $from;

    /**
     * @param string $from
     * @param string $path
     */
    public function __construct($from, $path)
    {
        parent::__construct($path);

        if (is_string($from)) {
            $from = new JsonPointer($from);
        }
        $this->from = $from;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke($document, AccessFacade $access)
    {
        if (!$access->isReadable($document, $this->from)) {
            throw new OperationException(sprintf('The path "%s" is not readable.', (string) $this->from));
        }

        $value = $access->get($document, $this->from);

        $removeOperation = new RemoveOperation($this->from);
        $addOperation = new AddOperation($this->path, $value);

        $document = $removeOperation($document, $access);
        $document = $addOperation($document, $access);

        return $document;
    }
}
