<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Common\Specification;

use Ngirardet\PhpDdd\Test\Fixture\Common\Specification\DummyAndSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Common\Specification\DummyNotSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Common\Specification\DummyOrSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Common\Specification\DummyBusinessCustomSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase {

    public function testSpecificationFalse() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Another dummy entity');
        $specification = new DummyBusinessCustomSpecification('Dummy entity');
        self::assertFalse($specification->isSatisfiedBy($entity));
    }

    public function testSpecificationTrue() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyBusinessCustomSpecification('Dummy entity');
        self::assertTrue($specification->isSatisfiedBy($entity));
    }

    public function testOrSpecificationFalse() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyOrSpecification('Some dummy entity', 'Another dummy entity');
        self::assertFalse($specification->isSatisfiedBy($entity));
    }

    public function testOrSpecificationTrue() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyOrSpecification('Dummy entity', 'Another dummy entity');
        self::assertTrue($specification->isSatisfiedBy($entity));
    }

    public function testAndSpecificationFalse() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyAndSpecification('Dummy entity', 'Another dummy entity');
        self::assertFalse($specification->isSatisfiedBy($entity));
    }

    public function testAndSpecificationTrue() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyAndSpecification('Dummy entity', 'Dummy entity');
        self::assertTrue($specification->isSatisfiedBy($entity));
    }

    public function testNotSpecificationFalse() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyNotSpecification('Dummy entity');
        self::assertFalse($specification->isSatisfiedBy($entity));
    }

    public function testNotSpecificationTrue() {
        $entity = $this->createStub(DummyEntity::class);
        $entity->method('getName')->willReturn('Dummy entity');
        $specification = new DummyNotSpecification('Another dummy entity');
        self::assertTrue($specification->isSatisfiedBy($entity));
    }
}
