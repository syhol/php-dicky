<?php

namespace Syhol\PhpDicky\Invoker;

use Exception;
use ReflectionFunctionAbstract;

class CallableInvoker implements Invoker
{
    /**
     * @var array|ArgumentResolver[]
     */
    private $resolvers = [];

    /**
     * CallableInvoker constructor.
     * @param ArgumentResolver[] $resolvers
     */
    public function __construct(ArgumentResolver ...$resolvers)
    {
        $this->resolvers = $resolvers;
    }

    public function call(callable $callable, array $inputArgs = [])
    {
        return $callable(...$this->resolve($callable, $inputArgs));
    }

    public function resolve(callable $callable, array $inputArgs = [])
    {
        $resolvedArgs = [];
        $reflect = (new CallableReflectionFactory)->parse($callable);

        foreach ($this->resolvers as $resolver) {
            $resolvedArgs = $resolver->resolveArguments($resolvedArgs, $reflect, $inputArgs);
        }

        $this->checkResolutions($reflect, $resolvedArgs);

        return $resolvedArgs;
    }

    /**
     * @param ReflectionFunctionAbstract $reflect
     * @param array $resolvedArgs
     * @throws Exception
     */
    private function checkResolutions(ReflectionFunctionAbstract $reflect, array $resolvedArgs)
    {
        $parameters = $reflect->getParameters();

        foreach ($parameters as $index => $parameter) {
            if (!isset($resolvedArgs[$index]) && !$parameter->isOptional()) {
                throw new Exception('Can not resolve parameter $' . $parameter->getName());
            }
        }
    }
}
