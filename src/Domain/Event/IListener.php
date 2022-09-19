<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Event;

/**
 * Interface for event listeners
 */
interface IListener {
    /**
     * Callback method called when subscribed event is triggered
     * @param \Ngirardet\PhpDdd\Domain\Event\IEvent $aDomainEvent
     */
    public function handle(IEvent $aDomainEvent): void;

    /**
     * Class name of the subscribed event
     * @param string $eventClassName
     *
     * @return bool
     */
    public function isSubscribedTo(string $eventClassName): bool;
}
