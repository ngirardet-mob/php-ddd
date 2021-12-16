<?php
/**
 * Author: ngirardet
 * Date: 16.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Domain\Entity;

abstract class ValueObject {
    abstract public function isSameAs(self $compareTo): bool;
}
