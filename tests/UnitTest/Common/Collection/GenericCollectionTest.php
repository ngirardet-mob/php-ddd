<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Common\Collection;

use ArrayIterator;
use Ngirardet\PhpDdd\Common\Collection\GenericCollection;
use Ngirardet\PhpDdd\Test\Fixture\Common\Collection\DummyGenericCollection;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use PHPUnit\Framework\TestCase;

class GenericCollectionTest extends TestCase {
    public function testInitialization(): DummyGenericCollection {
        $entity = $this->createMock(DummyEntity::class);
        $collection = new DummyGenericCollection($entity);
        self::assertInstanceOf(GenericCollection::class, $collection);

        return $collection;
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Common\Collection\DummyGenericCollection $collection
     *
     * @return void
     * @throws \Exception
     * @depends testInitialization
     */
    public function testGetIterator(DummyGenericCollection $collection) {
        self::assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    /**
     * @return void
     * @depends testInitialization
     */
    public function testToArray(DummyGenericCollection $collection) {
        $entity = $this->createMock(DummyEntity::class);
        self::assertEquals([$entity], $collection->toArray());
    }

    /**
     * @return void
     * @depends testInitialization
     */
    public function testCount(DummyGenericCollection $collection) {
        self::assertCount(1, $collection);
        self::assertEquals(1, $collection->count());
    }

    /**
     * @return void
     * @depends testInitialization
     */
    public function testMerge(DummyGenericCollection $collection) {
        $entity = $this->createMock(DummyEntity::class);
        self::assertSame($collection, $collection->merge(new DummyGenericCollection($entity)));
    }
}
