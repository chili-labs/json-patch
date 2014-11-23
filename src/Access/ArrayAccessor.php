<?php
namespace ChiliLabs\JsonPatch\Access;

class ArrayAccessor implements AccessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($document)
    {
        return is_array($document);
    }

    /**
     * {@inheritdoc}
     */
    public function get($path)
    {
        // TODO: Implement get() method.
    }

    /**
     * {@inheritdoc}
     */
    public function set($path, $value)
    {
        // TODO: Implement set() method.
    }

    /**
     * {@inheritdoc}
     */
    public function has($path)
    {
        // TODO: Implement has() method.
    }

}
