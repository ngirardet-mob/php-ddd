<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Event;

use BadMethodCallException;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Global instance gathering and dispatching events
 * @note EventDispatcherInterface could be in another class for a better separation of concern
 */
class Publisher implements EventDispatcherInterface, ListenerProviderInterface {
    /**
     * @var \Ngirardet\PhpDdd\Domain\Event\IListener[]
     */
    private array $listeners;
    private static self $instance;

    /**
     * Self unique instance (singleton)
     * @return static
     */
    public static function instance(): static
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Constructor
     */
    private function __construct()
    {
        $this->listeners = [];
    }

    /**
     * Clone is forbidden
     * @throws BadMethodCallException
     */
    public function __clone()
    {
        throw new BadMethodCallException('Clone is not supported. You must use this unique instance.');
    }

    /**
     * Register new subscription
     * @param \Ngirardet\PhpDdd\Domain\Event\IListener $domainEventListener
     *
     * @return void
     */
    public function subscribe(IListener $domainEventListener): void {
        $this->listeners[] = $domainEventListener;
    }

    /**
     * Call registered listeners
     *
     * @param object|\Ngirardet\PhpDdd\Domain\Event\IEvent $event IEvent
     *
     * @return \Ngirardet\PhpDdd\Domain\Event\IEvent IEvent
     */
    public function dispatch(object $event): IEvent
    {
        foreach ($this->getListenersForEvent($event) as $listener) {
            $listener->handle($event);
        }

        return $event;
    }

    /**
     * Retrieve listeners subscribed to an event
     * @param object $event IEvent
     *
     * @return iterable List of listeners
     */
    public function getListenersForEvent(object $event): iterable {
        $listenersForEvent = [];
        foreach ($this->listeners as $listener) {
            if ($listener->isSubscribedTo(get_class($event))) {
                $listenersForEvent[] = $listener;
            }
        }

        return $listenersForEvent;
    }
}
