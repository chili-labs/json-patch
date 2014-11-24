<?php
namespace ChiliLabs\JsonPatch\Access;

use ChiliLabs\JsonPatch\Exception\InvalidPathException;
use ChiliLabs\JsonPointer\JsonPointer;

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
    public function get($document, JsonPointer $path)
    {
        $value = $document;
        foreach ($path->toArray() as $pathParts) {
            if (!array_key_exists($pathParts, $value)) {
                throw new InvalidPathException(
                    sprintf('The element "%s" in the path "%s" does not exist in the document.', $pathParts, $path)
                );
            }
            $value = $value[$pathParts];
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function set($document, JsonPointer $path, $value)
    {
        $element = &$document;
        foreach ($path->toArray() as $pathParts) {
            if (!array_key_exists($pathParts, $element)) {
                throw new InvalidPathException(
                    sprintf('The element "%s" in the path "%s" does not exist in the document.', $pathParts, $path)
                );
            }
            $element = &$element[$pathParts];
        }

        $element = $value;

        return $document;
    }

    /**
     * {@inheritdoc}
     */
    public function has($document, JsonPointer $path)
    {
        foreach ($path->toArray() as $pathParts) {
            if (!array_key_exists($pathParts, $document)) {
                return false;
            }
        }

        return true;
    }
}
