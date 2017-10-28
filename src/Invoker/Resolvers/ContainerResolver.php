<?php

namespace Syhol\PhpDicky\Invoker\Resolvers;

use Psr\Container\ContainerInterface;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use Syhol\PhpDicky\Invoker\ArgumentResolver;

class ContainerResolver implements ArgumentResolver
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ContainerResolver constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function resolveArguments(array $resolvedArgs, ReflectionFunctionAbstract $reflect, array $inputArgs)
    {
        foreach($reflect->getParameters() as $index => $parameter) {
            $type = $parameter->getType();
            if (!isset($resolvedArgs[$index]) && $type && $this->container->has((string)$type)) {
                $resolvedArgs[$index] = $this->container->get((string)$type);
            }
        }

        return $resolvedArgs;
    }

//    public function resolveCallable(callable $callable, ReflectionFunctionAbstract $reflect)
//    {
//        if ($reflect instanceof ReflectionMethod && is_array($callable)) {
//            return $this->resolveMethod($callable, $reflect);
//        }
//
//        return $callable;
//    }
//
//    private function resolveMethod(array $callable, ReflectionMethod $reflect)
//    {
//        list($subject, $method) = $callable;
//
//        if ($reflect->isStatic() && is_string($subject)) {
//            return [$this->container->get($subject), $method];
//        }
//
//        return $callable;
//    }
}
