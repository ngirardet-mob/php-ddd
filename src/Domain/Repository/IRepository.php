<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Repository;

use Countable;
use Iterator;
use IteratorAggregate;

/**
 * @template T
 */
interface IRepository extends Countable, IteratorAggregate {
    /**
     * Get array object iterator
     *
     * @return Iterator
     */
    public function getIterator(): Iterator;

    /**
     * Count elements
     *
     * @return integer
     */
    public function count(): int;

    /**
     * Next RDBMS table identifier
     * @return mixed
     */
    public function nextId(): mixed;
}
