<?php

namespace App\Events;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class PsrEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private ListenerProviderInterface $provider) {}

    public function dispatch(object $event): object
    {
        foreach ($this->provider->getListenersForEvent($event) as $listener) {
            $listener($event);

            if (method_exists($event, 'isPropagationStopped') && $event->isPropagationStopped()) {
                break;
            }
        }
        return $event;
    }
}
