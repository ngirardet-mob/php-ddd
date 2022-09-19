<?php

namespace Ngirardet\PhpDdd\Domain\Event;

/**
 * Helper for dispatching an event
 */
trait EventDispatcherTrait {
    /**
     * @template RealInstanceType of object
     * @param    \Ngirardet\PhpDdd\Domain\Event\IEvent&class-string<RealInstanceType> $event
     *
     * @return RealInstanceType&\Ngirardet\PhpDdd\Domain\Event\IEvent
     */
    private static function dispatch(IEvent $event): IEvent {
        return Publisher::instance()->dispatch($event);
    }
}
