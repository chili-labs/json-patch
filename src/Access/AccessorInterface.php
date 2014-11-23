<?php
namespace ChiliLabs\JsonPatch\Access;

interface AccessorInterface
{
    /**
     * @param mixed $document
     * @return bool
     */
    public function supports($document);

    /**
     * @param string $path
     * @return mixed
     */
    public function get($path);

    /**
     * @param string $path
     * @param mixed $value
     */
    public function set($path, $value);

    /**
     * @param string $path
     * @return bool
     */
    public function has($path);
}
