<?php

namespace Syhol\PhpDicky;

use ArrayAccess;
use Exception;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Syhol\PhpDicky\Definitions\Create;
use Syhol\PhpDicky\Invoker\CallableInvoker;
use Syhol\PhpDicky\Invoker\Invoker;
use Syhol\PhpDicky\Invoker\Resolvers\ContainerResolver;
use Syhol\PhpDicky\Invoker\Resolvers\DefaultResolver;
use Syhol\PhpDicky\Invoker\Resolvers\InputResolver;

class Container implements ArrayAccess, ContainerInterface, Invoker
{
    /** @var Resolvable[] */
    private $definitions = [];

    /** @var Invoker */
    private $invoker;

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
        if ($this->definitions[$id]) {
            return $this->definitions[$id]->resolve($this);
        }

        if (class_exists($id)) {
            return (new Create($id))->resolve($this);
        }

        throw new class extends Exception implements NotFoundExceptionInterface {};
    }

    /**
     * @inheritdoc
     */
    public function has($id)
    {
        return isset($this->definitions[$id]);
    }

    public function set($id, Resolvable $factory)
    {
        $this->definitions[$id] = $factory;

        return $this;
    }

    public function remove($id)
    {
        unset($this->definitions[$id]);

        return $this;
    }

    public function call(callable $callable, array $inputArgs = [])
    {
        return $this->getInvoker()->call($callable, $inputArgs);
    }

    public function resolve(callable $callable, array $inputArgs = [])
    {
        return $this->getInvoker()->resolve($callable, $inputArgs);
    }

    public function getInvoker()
    {
        return $this->invoker ?? $this->invoker = new CallableInvoker(
            new ContainerResolver($this),
            new InputResolver(),
            new DefaultResolver()
        );
    }

    public function setInvoker(Invoker $invoker)
    {
        $this->invoker = $invoker;
    }
}