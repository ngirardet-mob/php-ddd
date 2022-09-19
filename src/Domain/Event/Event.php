<?php

namespace Ngirardet\PhpDdd\Domain\Event;

use DateTimeImmutable;

/**
 * Helper for IEvent implementing default occurredOn method
 */
abstract class Event implements IEvent {
    /**
     * Get current datetime of the event
     * @return \DateTimeImmutable
     */
    public function occurredOn(): DateTimeImmutable {
        return new DateTimeImmutable();
    }
}
