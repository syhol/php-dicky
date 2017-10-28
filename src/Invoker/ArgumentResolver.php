<?php

namespace Syhol\PhpDicky\Invoker;

use ReflectionFunctionAbstract;

interface ArgumentResolver
{
    public function resolveArguments(array $resolvedArgs, ReflectionFunctionAbstract $reflect, array $inputArgs);
}
