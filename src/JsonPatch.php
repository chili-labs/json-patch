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

use ChiliLabs\JsonPatch\Operation\OperationInterface;

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

//    public static function fromJson($jsonPatch) {
//        if (is_string($jsonPatch)) {
//            $jsonPatch = json_decode($jsonPatch, true);
//        }
//
//        $operations = [];
//
//        return new static($operations);
//    }
//
//    private static function validateJsonPatch(array $jsonPatch) {
//        foreach ($jsonPatch as $operation) {
//
//        }
//    }
//
//    private static function validateOperation(array $operation) {
//        foreach ($operation as $key => $value) {
//            switch ($key) {
//                case 'op':
//                    if (!constant('OperationInterface::' . strtoupper($value))) {
//                        throw new
//                    }
//            }
//        }
//    }
}
