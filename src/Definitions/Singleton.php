<?php

namespace Syhol\PhpDicky\Definitions;

use Syhol\PhpDicky\Container;
use Syhol\PhpDicky\Resolvable;

class Singleton implements Resolvable
{
    /** @var callable  */
    private $callable;

    private $instance;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function getCallable()
    {
        return $this->callable;
    }

    public function resolve(Container $container)
    {
        if (isset($this->instance)) {
            return $this->instance;
        }

        return $this->instance = ($this->callable)($container);
    }
}