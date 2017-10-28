<?php

namespace Syhol\PhpDicky;

class MessageBus
{
    private $listeners = [];

    public function push(Message $event, ...$args)
    {
        if (isset($this->listeners[get_class($event)])) {
            foreach ($this->listeners[get_class($event)] as $listener) {
                $listener($event, ...$args);
            }
        }
    }

    public function on($topic, callable $callable)
    {
        if (!isset($this->listeners[$topic])) {
            $this->listeners[$topic] = [];
        }

        $this->listeners[$topic][] = $callable;

        return $this;
    }
}
