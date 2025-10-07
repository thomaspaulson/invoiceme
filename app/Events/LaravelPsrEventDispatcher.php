<?php

namespace App\Events;

use Illuminate\Contracts\Events\Dispatcher as LaravelDispatcher;
use Psr\EventDispatcher\EventDispatcherInterface;

class LaravelPsrEventDispatcher implements EventDispatcherInterface
{
    public function __construct(private LaravelDispatcher $laravelDispatcher) {}

    public function dispatch(object $event): object
    {
        $this->laravelDispatcher->dispatch($event);
        return $event;
    }
}
