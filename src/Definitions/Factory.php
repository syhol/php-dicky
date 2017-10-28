<?php

namespace Syhol\PhpDicky\Definitions;

use Syhol\PhpDicky\Container;
use Syhol\PhpDicky\Resolvable;

class Factory implements Resolvable
{
    /** @var callable  */
    private $callable;

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
        return ($this->callable)($container);
    }
}