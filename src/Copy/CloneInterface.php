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
interface CloneInterface
{
    /**
     * @param mixed $document
     *
     * @return mixed
     */
    public function cloneDocument($document);
}
