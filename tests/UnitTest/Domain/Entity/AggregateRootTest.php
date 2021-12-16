<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Domain\Entity;

use Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot;
use Ngirardet\PhpDdd\Infrastructure\Helper\Identity\CompositeIdentity;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;
use PHPUnit\Framework\TestCase;

class AggregateRootTest extends TestCase {
    public function testConstruction(): DummyEntity {
        $id = $this->createMock(DummyCompositeIdentity::class);
        $entity = new DummyEntity($id, "Dummy entity");
        self::assertInstanceOf(IAggregateRoot::class, $entity);

        return $entity;
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity $entity
     *
     * @return void
     *
     * @depends testConstruction
     */
    public function testGetEntityId(DummyEntity $entity) {
        self::assertInstanceOf(CompositeIdentity::class, $entity->getId());
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity $entity
     *
     * @return void
     *
     * @depends testConstruction
     */
    public function testEntityGetProperty(DummyEntity $entity) {
        self::assertEquals('Dummy entity', $entity->getName());
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity $entity
     *
     * @return void
     *
     * @depends testConstruction
     */
    public function testEntitySetProperty(DummyEntity $entity) {
        self::assertSame($entity, $entity->setName('Dummy entity renamed'));
        self::assertEquals('Dummy entity renamed', $entity->getName());
    }
}
