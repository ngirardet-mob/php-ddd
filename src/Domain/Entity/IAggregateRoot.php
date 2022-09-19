<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Entity;

/**
 * Interface base definition of AggregateRoot entity
 * Rules of thumb:
 * - An aggregate root has an ID
 * @template T
 */
interface IAggregateRoot {
    public function getId(): ?IIdentity;
}
