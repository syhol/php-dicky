<?php

namespace Syhol\PhpDicky\Invoker;

interface Invoker
{
    public function call(callable $callable, array $arguments = []);
}
