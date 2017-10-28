<?php

namespace Syhol\PhpDicky\Definitions;

use Syhol\PhpDicky\Container;
use Syhol\PhpDicky\Resolvable;

class EnvironmentVariable implements Resolvable
{
    /** @var string */
    private $key;

    /** @var mixed */
    private $default;

    /** @var bool  */
    private $required = false;

    /** @var string */
    private $description;

    public function __construct(string $key, $default = null)
    {
        $this->key = $key;
        $this->default = $default;
    }

    public function description(string $description)
    {
        $this->description = $description;
    }

    public function required(bool $toggle = true)
    {
        $this->required = $toggle;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function resolve(Container $container)
    {
        return getenv($this->key);
    }
}