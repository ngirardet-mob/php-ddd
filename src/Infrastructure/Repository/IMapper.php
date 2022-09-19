<?php
namespace Ngirardet\PhpDdd\Infrastructure\Repository;

use Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot;

/**
 * DTO mapping business entity to/from infrastructure
 */
interface IMapper {
    /**
     * @template T
     *
     * @param \Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot<T> $businessEntity
     *
     * @return mixed
     */
    public static function toRepository(IAggregateRoot $businessEntity): mixed;

    /**
     * @param mixed $repositoryEntity
     *
     * @return \Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot
     * @template T
     * @template-implements IAggregateRoot<T>
     */
    public static function toBusiness(mixed $repositoryEntity): IAggregateRoot;
}
