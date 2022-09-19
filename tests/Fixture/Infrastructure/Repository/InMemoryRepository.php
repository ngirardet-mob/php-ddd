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
use Ngirardet\PhpDdd\Infrastructure\Repository\IMapper;

abstract class InMemoryRepository implements IRepository {
    protected array $memory = [];
    protected IMapper $mapper;

    public function getIterator(): Iterator {
        foreach ($this->memory as $next) {
            yield $this->mapper::toBusiness($next);
        }
    }

    public function count(): int {
        $array = new ArrayObject($this->memory);

        return $array->count();
    }

    public function nextId(): int {
        return count($this->memory) + 1;
    }

    protected function filter(callable $filter): static {
        $clone = clone $this;
        $clone->memory = array_filter($clone->memory, $filter);

        return $clone;
    }

    public function toArray(): array {
        return iterator_to_array($this->getIterator());
    }
}
