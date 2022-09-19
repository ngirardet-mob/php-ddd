<?php
/**
 * Author: ngirardet
 * Date: 16.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Domain\Repository;

use Ngirardet\PhpDdd\Domain\Repository\IRepository;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;

interface IDummyRepository extends IRepository {
    public function save(DummyEntity $entity): DummyEntity;

    public function get(DummyCompositeIdentity $identity): DummyEntity;
}
