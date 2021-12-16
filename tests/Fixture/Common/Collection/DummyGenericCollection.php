<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Common\Collection;

use Ngirardet\PhpDdd\Common\Collection\GenericCollection;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;

/**
 * @template-implements GenericCollection<DummyEntity>
 */
class DummyGenericCollection extends GenericCollection {
    public function __construct(DummyEntity ...$entities) {
        $this->collection = $entities;
    }
}
