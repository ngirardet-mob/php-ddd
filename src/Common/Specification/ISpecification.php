<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common\Specification;

/**
 * @template ISpecification<T>
 */
interface ISpecification {
    public function isSatisfiedBy($element): bool;
}
