<?php

namespace Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository;

use Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot;
use Ngirardet\PhpDdd\Infrastructure\Repository\IMapper;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;

class DummyMapper implements IMapper {

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity $businessEntity
     */
    public static function toRepository(IAggregateRoot $businessEntity): mixed {
        return [
            'id' => $businessEntity->getId()->toArray(),
            'name' => $businessEntity->getName()
        ];
    }

    /**
     * @inheritDoc
     */
    public static function toBusiness(mixed $repositoryEntity): IAggregateRoot {
        return new DummyEntity(
            DummyCompositeIdentity::fromArray($repositoryEntity['id']),
            $repositoryEntity['name']
        );
    }
}
