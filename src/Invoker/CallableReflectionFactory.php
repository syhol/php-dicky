<?php

namespace Syhol\PhpDicky\Invoker;

use Closure;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use ReflectionFunction;
use Exception;

class CallableReflectionFactory
{
    /**
     * @param callable $callable
     * @return ReflectionFunctionAbstract
     * @throws Exception
     */
    public function parse(callable $callable)
    {
        $reflection = null;

        if (is_string($callable) && strpos($callable, '::') !== false)
            $callable = explode('::', $callable, 2);

        if (is_array($callable) && count($callable) === 2) {
            return $this->parseMethod($callable);
        } elseif ($callable instanceof Closure || is_string($callable)) {
            return new ReflectionFunction($callable);
        } elseif (is_object($callable) && method_exists($callable, '__invoke')) {
            return new ReflectionMethod($callable, '__invoke');
        } else {
            throw new Exception('Could not parse function');
        }
    }

    /**
     * @param array $callable
     * @return ReflectionMethod
     * @throws Exception
     */
    private function parseMethod(array $callable)
    {
        list($class, $method) = array_values($callable);

        if (is_string($class) && ! method_exists($class, $method)) {
            $method = '__callStatic';
        }

        if (is_object($class) && ! method_exists($class, $method)) {
            $method = '__call';
        }

        return new ReflectionMethod($class, $method);
    }
}