<?php
/**
 * Author: ngirardet
 * Date: 16.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository;

use Ngirardet\PhpDdd\Common\Specification\ISpecification;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Repository\IDummyRepository;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;

class DummyInMemoryRepository extends InMemoryRepository implements IDummyRepository {
    public function __construct(

    ) {
        $this->mapper = new DummyMapper();
    }

    public function save(DummyEntity $entity): DummyEntity {
        $repositoryEntity = $this->mapper::toRepository($entity);
        $this->memory[$this->_compositeIdToString($entity->getId())] = $repositoryEntity;

        return $this->mapper::toBusiness($repositoryEntity);
    }

    public function get(DummyCompositeIdentity $identity): DummyEntity {
        return $this->mapper::toBusiness($this->memory[$this->_compositeIdToString($identity)]);
    }

    public function find(ISpecification $specification): self {
        return $this->filter([$specification, 'isSatisfiedBy']);
    }

    private function _compositeIdToString(DummyCompositeIdentity $identity): string {
        return implode(',', $identity->toArray());
    }
}
