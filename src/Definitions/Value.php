<?php

namespace Syhol\PhpDicky\Definitions;

use Syhol\PhpDicky\Container;
use Syhol\PhpDicky\Resolvable;

class Value implements Resolvable
{
    /** @var mixed */
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function resolve(Container $container)
    {
        return $this->value;
    }
}