<?php

namespace Syhol\PhpDicky\Invoker\Resolvers;

use ReflectionFunctionAbstract;
use Syhol\PhpDicky\Invoker\ArgumentResolver;

class InputResolver implements ArgumentResolver
{
    public function resolveArguments(array $resolvedArgs, ReflectionFunctionAbstract $reflect, array $inputArgs)
    {
        foreach($reflect->getParameters() as $index => $parameter) {
            if (!isset($resolvedArgs[$index])) {
                $type = $parameter->getType();
                if ($inputArgs[$parameter->getName()]) {
                    $resolvedArgs[$index] = $inputArgs[$parameter->getName()];
                } elseif ($type && !$type->isBuiltin() && isset($inputArgs[(string)$type])) {
                    $resolvedArgs[$index] = $inputArgs[(string)$type];
                }
            }
        }

        return $resolvedArgs;
    }
}
