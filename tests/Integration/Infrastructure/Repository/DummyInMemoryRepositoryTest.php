<?php
/**
 * Author: ngirardet
 * Date: 16.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Integration\Infrastructure\Repository;

use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\DummyInMemoryRepository;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\InMemoryRepository;
use PHPUnit\Framework\TestCase;

class DummyInMemoryRepositoryTest extends TestCase {

    public function testConstruction(): DummyInMemoryRepository {
        $repository = new DummyInMemoryRepository();
        self::assertInstanceOf(DummyInMemoryRepository::class, $repository);

        return $repository;
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\DummyInMemoryRepository $repository
     *
     * @return void
     *
     * @depends testConstruction
     */
    public function testSave(DummyInMemoryRepository $repository): InMemoryRepository {
        $entityId = DummyCompositeIdentity::fromArray(['id' => 1, 'ref' => 2]);
        $entity = new DummyEntity($entityId, 'Dummy entity');

        self::assertTrue($repository->save($entity));

        return $repository;
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\DummyInMemoryRepository $repository
     *
     * @return void
     *
     * @depends testSave
     */
    public function testGet(DummyInMemoryRepository $repository) {
        $entityId = DummyCompositeIdentity::fromArray(['id' => 1, 'ref' => 2]);
        self::assertInstanceOf(DummyEntity::class, $repository->get($entityId));
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\DummyInMemoryRepository $repository
     *
     * @return void
     *
     * @depends testSave
     */
    public function testGetIterator(DummyInMemoryRepository $repository) {
        self::assertIsIterable($repository->getIterator());
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\DummyInMemoryRepository $repository
     *
     * @return void
     *
     * @depends testSave
     */
    public function testCount(DummyInMemoryRepository $repository) {
        self::assertCount(1, $repository);
    }

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository\DummyInMemoryRepository $repository
     *
     * @return void
     *
     * @depends testSave
     */
    public function testNextId(DummyInMemoryRepository $repository) {
        self:self::assertEquals(2, $repository->nextId());
    }
}
