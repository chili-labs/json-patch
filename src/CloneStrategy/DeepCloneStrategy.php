<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\CloneStrategy;

use DeepCopy\DeepCopy;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class DeepCloneStrategy implements CloneStrategyInterface
{
    /**
     * @var DeepCopy
     */
    private $deepCopy;

    /**
     * @param DeepCopy $deepCopy
     */
    public function __construct(DeepCopy $deepCopy)
    {
        $this->deepCopy = $deepCopy;
    }

    /**
     * @param mixed $document
     *
     * @return mixed
     */
    public function cloneDocument($document)
    {
        return $this->deepCopy->copy($document);
    }
}
