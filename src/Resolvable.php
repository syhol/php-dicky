<?php

namespace Syhol\PhpDicky;

interface Resolvable
{
    public function resolve(Container $container);
}