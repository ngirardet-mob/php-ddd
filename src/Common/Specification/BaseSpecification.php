<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common\Specification;

use Closure;

/**
 * @template T
 * @template-implements \Ngirardet\PhpDdd\Common\Specification\ISpecification<T>
 */
abstract class BaseSpecification implements ISpecification {
    private Closure $compiledExpression;

    /**
     * @param T $element
     *
     * @return callable(T): bool
     */
    abstract protected function getSpecExpression(mixed $element): callable;

    /**
     * @param T $element
     *
     * @return callable(T): bool
     */
    private function compiledExpression(mixed $element): callable {
        return $this->compiledExpression ?? ($this->compiledExpression = $this->getSpecExpression($element));
    }

    /**
     * @param T $element
     *
     * @return bool
     */
    public function isSatisfiedBy($element): bool {
        $result = $this->compiledExpression($element);

        return call_user_func($result);
    }
}
