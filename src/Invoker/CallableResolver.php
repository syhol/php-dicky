<?php

namespace Syhol\PhpDicky\Invoker;

use ReflectionFunctionAbstract;

interface CallableResolver
{
    public function resolveArguments(array $resolvedArgs, ReflectionFunctionAbstract $reflect, array $inputArgs);
}
