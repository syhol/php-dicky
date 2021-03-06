<?php

namespace Syhol\PhpDicky\Definitions;

use Syhol\PhpDicky\Container;
use Syhol\PhpDicky\Resolvable;

class Create implements Resolvable
{
    /** @var mixed */
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function resolve(Container $container)
    {
        $arguments = $container->resolve([$this->class. '__construct']);

        return new $this->class(...$arguments);
    }
}