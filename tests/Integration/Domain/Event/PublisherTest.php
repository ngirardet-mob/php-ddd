<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Integration\Domain\Event;

use DateTimeImmutable;
use Ngirardet\PhpDdd\Domain\Event\Publisher;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Event\DummyEvent;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Event\DummyEventListener;
use PHPUnit\Framework\TestCase;

class PublisherTest extends TestCase {

    public function testEventSubscriptionAndDispatch() {
        $eventListener = new DummyEventListener();
        $dummyEvent = new DummyEvent('plop');
        Publisher::instance()->subscribe($eventListener);
        Publisher::instance()->dispatch($dummyEvent);
        self::assertTrue($eventListener->getEventHasTriggered());
        self::assertInstanceOf(DateTimeImmutable::class, $dummyEvent->occurredOn());
        self::assertEquals('plop', $dummyEvent->getSomeValue());
    }
}
