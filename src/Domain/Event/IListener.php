<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Event;

interface IListener {
    /**
     * @param \Ngirardet\PhpDdd\Domain\Event\IEvent $aDomainEvent
     */
    public function handle(IEvent $aDomainEvent): void;

    /**
     * @param \Ngirardet\PhpDdd\Domain\Event\IEvent $aDomainEvent
     * @return bool
     */
    public function isSubscribedTo(IEvent $aDomainEvent): bool;
}
