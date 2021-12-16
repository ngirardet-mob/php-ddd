<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Domain\Entity;

use Ngirardet\PhpDdd\Domain\Entity\IAggregateRoot;
use Ngirardet\PhpDdd\Infrastructure\Helper\Identity\CompositeIdentity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;

class DummyEntity implements IAggregateRoot {
    public function __construct(private DummyCompositeIdentity $id, private string $name) {}

    public function getId(): DummyCompositeIdentity {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }
}
