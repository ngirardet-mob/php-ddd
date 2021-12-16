<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common\Specification;

/**
 * @template T
 * @template-implements \Ngirardet\PhpDdd\Common\Specification\BaseSpecification<T>
 */
class NotSpecification extends BaseSpecification {
    public function __construct(private ISpecification $specification) {}

    /**
     * @param T $element
     *
     * @return callable
     */
    protected function getSpecExpression(mixed $element): callable {
        return fn () => !$this->specification->isSatisfiedBy($element);
    }
}
