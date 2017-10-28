<?php

namespace Syhol\PhpDicky;

use Syhol\PhpDicky\Definitions\Create;
use Syhol\PhpDicky\Definitions\EnvironmentVariable;
use Syhol\PhpDicky\Definitions\Factory;
use Syhol\PhpDicky\Definitions\Singleton;
use Syhol\PhpDicky\Definitions\Value;

function env($key, $default = null)
{
    return new EnvironmentVariable($key, $default);
}

function value($value)
{
    return new Value($value);
}

function factory(callable $callable)
{
    return new Factory($callable);
}

function shared(callable $callable)
{
    return new Singleton($callable);
}

function create($class)
{
    return new Create($class);
}
