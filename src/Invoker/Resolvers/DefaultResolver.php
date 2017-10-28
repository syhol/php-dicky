<?php

namespace Syhol\PhpDicky\Invoker\Resolvers;

use ReflectionFunctionAbstract;
use Syhol\PhpDicky\Invoker\ArgumentResolver;

class DefaultResolver implements ArgumentResolver
{
    public function resolveArguments(array $resolvedArgs, ReflectionFunctionAbstract $reflect, array $inputArgs)
    {
        foreach($reflect->getParameters() as $index => $parameter) {
            if (!isset($resolvedArgs[$index]) && $parameter->isDefaultValueAvailable()) {
                $resolvedArgs[$index] = $parameter->getDefaultValue();
            }
        }

        return $resolvedArgs;
    }
}
