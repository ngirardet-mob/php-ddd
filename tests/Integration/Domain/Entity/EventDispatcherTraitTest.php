<?php

namespace Ngirardet\PhpDdd\Test\Integration\Domain\Entity;

use Ngirardet\PhpDdd\Domain\Event\Publisher;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Event\DummyEventListener;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;
use PHPUnit\Framework\TestCase;

class EventDispatcherTraitTest extends TestCase {
    public function testDispatch() {
        $entity = new DummyEntity(
            DummyCompositeIdentity::fromArray([1,2]),
            'Some dummy event'
        );

        $event = new DummyEventListener();

        Publisher::instance()->subscribe($event);

        $result = $entity->triggerEvent('Some event value');

        self::assertTrue($event->getEventHasTriggered());
        self::assertEquals('Some event value', $result->getSomeValue());
    }
}
