<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPatch\Copy;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class SimpleClone implements CloneInterface
{
    /**
     * @param mixed $document
     *
     * @return mixed
     */
    public function cloneDocument($document)
    {
        if (is_object($document)) {
            return clone $document;
        }

        return $document;
    }
}
