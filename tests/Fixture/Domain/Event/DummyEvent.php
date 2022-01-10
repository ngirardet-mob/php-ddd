<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Domain\Event;

use DateTimeImmutable;
use Ngirardet\PhpDdd\Domain\Event\IEvent;

class DummyEvent implements IEvent {
    public function __construct(private string $someValue) {

    }

    public function getSomeValue(): string {
        return $this->someValue;
    }

    public function occurredOn(): DateTimeImmutable {
        return new DateTimeImmutable();
    }
}
