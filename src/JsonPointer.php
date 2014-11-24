<?php

/*
 * This file is part of the json-patch library.
 *
 * (c) Daniel Tschinder
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChiliLabs\JsonPointer;

/**
 * @author Daniel Tschinder <daniel@tschinder.de>
 */
class JsonPointer
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * @param array $pathParts
     *
     * @return JsonPointer
     */
    public static function fromArray($pathParts)
    {
        $pathParts = self::escape($pathParts);

        return new JsonPointer(implode('/', $pathParts));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $pathParts = explode('/', $this->path);

        return self::unescape($pathParts);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }

    /**
     * @param array $pathParts
     *
     * @return array
     */
    private static function unescape($pathParts)
    {
        return str_replace(array('~1', '~0'), array('/', '~'), $pathParts);
    }

    /**
     * @param array $pathParts
     *
     * @return array
     */
    private static function escape($pathParts)
    {
        return str_replace(array('~', '/'), array('~0', '~1'), $pathParts);
    }
}
