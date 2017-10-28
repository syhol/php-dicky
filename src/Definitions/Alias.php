<?php

namespace Syhol\PhpDicky\Definitions;

use Syhol\PhpDicky\Container;
use Syhol\PhpDicky\Resolvable;

class Alias implements Resolvable
{
    /** @var mixed */
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function resolve(Container $container)
    {
        return $container->get($this->key);
    }
}