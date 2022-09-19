<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Domain\Event;

use Ngirardet\PhpDdd\Domain\Event\IEvent;
use Ngirardet\PhpDdd\Domain\Event\IListener;

class DummyEventListener implements IListener {
    private bool $eventHasTriggered = false;

    /**
     * @inheritDoc
     */
    public function handle(DummyEvent|IEvent $aDomainEvent): void {
        // Do some operations when event is triggered
        $this->eventHasTriggered = true;
    }

    public function getEventHasTriggered(): bool {
        return $this->eventHasTriggered;
    }

    /**
     * @inheritDoc
     */
    public function isSubscribedTo(string $eventClassName): bool {
        return $eventClassName === DummyEvent::class;
    }
}
