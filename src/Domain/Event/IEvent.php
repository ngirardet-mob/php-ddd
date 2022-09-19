<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Event;

use DateTimeInterface;

/**
 * Base interface for Events
 */
interface IEvent {
    /**
     * Datetime of the event
     * @return DateTimeInterface
     */
    public function occurredOn(): DateTimeInterface;
}
