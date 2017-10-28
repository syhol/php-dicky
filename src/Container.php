<?php

namespace Syhol\PhpDicky;

use ArrayAccess;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Syhol\PhpDicky\Resolvable;

class Container implements ArrayAccess, ContainerInterface
{
    /** @var Resolvable[] */
    private $definitions = [];

    /**
     * @inheritdoc
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset)
    {
        return $this->remove($offset);
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        if ($this->has($id)) {
            return $this->definitions[$id]->resolve($this);
        }

        throw new class extends Exception implements NotFoundExceptionInterface {};
    }

    /**
     * @inheritdoc
     */
    public function has($id)
    {

    }

    public function set($id, callable $factory)
    {

    }

    /**
     * @param Resolvable $resolvable
     */
    public function addDefinition(Resolvable $resolvable)
    {
        $this->definitions[] = $resolvable;
    }

    public function remove($id)
    {

    }
}