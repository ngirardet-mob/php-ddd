<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Event;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class Publisher implements EventDispatcherInterface, ListenerProviderInterface {
    private array $listeners;
    private static self $instance;

    public static function instance(): static
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __construct()
    {
        $this->listeners = [];
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    public function subscribe(IListener $domainEventListener, bool $allowMultipleRegistrations = true)
    {
        if (!$allowMultipleRegistrations && $this->isRegistered(get_class($domainEventListener))) {
            return;
        }

        $this->listeners[] = $domainEventListener;
    }

    public function isRegistered(string $domainEventListenerClassName): bool {
        foreach ($this->listeners as $listener) {
            if (get_class($listener) === $domainEventListenerClassName) {
                return true;
            }
        }

        return false;
    }

    public function dispatch(object $event): object
    {
        foreach ($this->getListenersForEvent($event) as $listener) {
            $listener->handle($event);
        }

        return $event;
    }

    public function getListenersForEvent(object $event): iterable {
        $listenersForEvent = [];
        foreach ($this->listeners as $listener) {
            if ($listener->isSubscribedTo($event)) {
                $listenersForEvent[] = $listener;
            }
        }

        return $listenersForEvent;
    }
}
