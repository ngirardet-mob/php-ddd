<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Generic collection
 * @template T
 */
abstract class GenericCollection implements IteratorAggregate, Countable {

    protected array $collection;

    /**
     * {@inheritdoc}
     */
    public function getIterator(): ArrayIterator {
        return new ArrayIterator($this->collection);
    }

    /**
     * Merge two collections
     * @param GenericCollection<T> $collection
     *
     * @return GenericCollection<T>
     */
    public function merge(GenericCollection $collection): self {
        $this->collection = array_merge($this->collection, $collection->collection);

        return $this;
    }

    /**
     * Count elements in Collection
     * @return integer
     */
    public function count(): int {
        return count($this->collection);
    }

    /**
     * Convert collection to array
     *
     * @return array
     */
    public function toArray(): array {
        return iterator_to_array($this);
    }
}
