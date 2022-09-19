<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Domain\Event;

use Ngirardet\PhpDdd\Domain\Event\Event;

class DummyEvent extends Event {
    public function __construct(
        private string $someValue
    ) {}

    public function getSomeValue(): string {
        return $this->someValue;
    }
}
