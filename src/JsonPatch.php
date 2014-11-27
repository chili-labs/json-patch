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

use ChiliLabs\JsonPatch\Operation\AddOperation;
use ChiliLabs\JsonPatch\Operation\OperationInterface;
use ChiliLabs\JsonPatch\Operation\RemoveOperation;
use ChiliLabs\JsonPatch\Operation\ReplaceOperation;
use ChiliLabs\JsonPatch\Operation\TestOperation;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class JsonPatch
{
    /**
     * @var OperationInterface[]
     */
    private $operations = array();

    /**
     * @param OperationInterface[] $operations
     */
    public function __construct(array $operations = array())
    {
        $this->operations = $operations;
    }

    /**
     * @return array|OperationInterface[]
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param string|array $jsonPatch
     *
     * @return static
     */
    public static function fromJson($jsonPatch)
    {
        if (is_string($jsonPatch)) {
            $jsonPatch = json_decode($jsonPatch, true);
        }

        $operations = array();
        // todo better error handling
        foreach ($jsonPatch as $operation) {
            switch($operation['op']) {
                case AddOperation::NAME:
                    $operations[] = new AddOperation($operation['path'], $operation['value']);
                    break;
                case RemoveOperation::NAME:
                    $operations[] = new RemoveOperation($operation['path']);
                    break;
                case ReplaceOperation::NAME:
                    $operations[] = new ReplaceOperation($operation['path'], $operation['value']);
                    break;
                case TestOperation::NAME:
                    $operations[] = new TestOperation($operation['path'], $operation['value']);
                    break;
            }
        }

        return new static($operations);
    }
}
