<?php
/**
 * Author: ngirardet
 * Date: 05.01.2022
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Domain\Event;

use BadMethodCallException;
use Ngirardet\PhpDdd\Domain\Event\IEvent;
use Ngirardet\PhpDdd\Domain\Event\IListener;
use Ngirardet\PhpDdd\Domain\Event\Publisher;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;
use PHPUnit\Framework\TestCase;

class PublisherTest extends TestCase {
    private Publisher $domainEventPublisher;

    protected function setUp(): void {
        $this->domainEventPublisher = Publisher::instance();
    }

    public function testInstance() {
        self::assertSame(Publisher::instance(), $this->domainEventPublisher);
    }

    public function testSubscribeAndShouldBeInListeners() {
        $subscriber = $this->createMock(IListener::class);
        $subscriber->method('isSubscribedTo')->willReturn(true);
        $this->domainEventPublisher->subscribe($subscriber);
        self::assertContains($subscriber, $this->domainEventPublisher->getListenersForEvent($this->createMock(IEvent::class)));
    }

    public function testDispatch() {
        $event = $this->createMock(IEvent::class);
        self::assertSame($event, $this->domainEventPublisher->dispatch($event));
    }

    public function testSubscribeAndShouldNotBeInListeners() {
        $subscriber = $this->createMock(IListener::class);
        $subscriber->method('isSubscribedTo')->willReturn(false);
        $this->domainEventPublisher->subscribe($subscriber);
        self::assertNotContains($subscriber, $this->domainEventPublisher->getListenersForEvent($this->createMock(IEvent::class)));
    }

    public function test__clone() {
        self::expectException(BadMethodCallException::class);
        clone $this->domainEventPublisher;
    }

    public function testSubscriptionInstanceShouldBeMultiple() {
        $event = $this->createMock(IEvent::class);
        $eventListener = $this->createMock(IListener::class);
        $eventListener->method('isSubscribedTo')->willReturn(true);
        $this->domainEventPublisher->subscribe($eventListener);
        $this->domainEventPublisher->subscribe($eventListener);

        $eventListener->expects(new InvokedCount(2))->method('handle');

        $this->domainEventPublisher->dispatch($event);
    }

    public function testIsNotRegistered() {
        $mock = $this->getMockBuilder(IListener::class)
            ->setMockClassName('SomeUnregisteredListener')
            ->getMock();
        self::assertFalse($this->domainEventPublisher->isRegistered(get_class($mock)));
    }

    public function testIsRegistered() {
        $mock = $this->getMockBuilder(IListener::class)
            ->setMockClassName('SomeRegisteredListener')
            ->getMock();
        $this->domainEventPublisher->subscribe($mock);
        self::assertTrue($this->domainEventPublisher->isRegistered(get_class($mock)));
    }
}
