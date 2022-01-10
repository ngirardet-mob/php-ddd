<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Event;

use DateTimeImmutable;

interface IEvent {
    public function occurredOn(): DateTimeImmutable;
}
