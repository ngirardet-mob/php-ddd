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
class AndSpecification extends BaseSpecification {
    private array $specifications;

    public function __construct(ISpecification ...$specifications) {
        $this->specifications = $specifications;
    }

    /**
     * @param T $element
     *
     * @return callable
     */
    protected function getSpecExpression(mixed $element): callable {
        return fn () => array_reduce($this->specifications, fn ($result, $specification) => $result && $specification->isSatisfiedBy($element), true);
    }
}
