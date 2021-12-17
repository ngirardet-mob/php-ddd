<?php
/**
 * Author: ngirardet
 * Date: 16.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Repository;

use ArrayObject;
use Iterator;
use Ngirardet\PhpDdd\Domain\Repository\IRepository;

abstract class InMemoryRepository implements IRepository {
    protected array $memory = [];

    public function getIterator(): Iterator {
        $array = new ArrayObject($this->memory);

        return $array->getIterator();
    }

    public function count(): int {
        $array = new ArrayObject($this->memory);

        return $array->count();
    }

    public function nextId(): int {
        return count($this->memory) + 1;
    }
}
