<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Common\Specification;

use Ngirardet\PhpDdd\Common\Specification\BaseSpecification;
use Ngirardet\PhpDdd\Common\Specification\OrSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;

/**
 * @template-implements BaseSpecification<\Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity>
 * @method isSatisfiedBy(DummyEntity $element)
 */
class DummyOrSpecification extends BaseSpecification {

    public function __construct(private string $firstEntityName, private string $secondEntityName) {}

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity $element
     *
     * @return callable
     */
    protected function getSpecExpression(mixed $element): callable {
        return function () use ($element): bool {
            $orSpec = new OrSpecification(
                new DummyBusinessCustomSpecification($this->firstEntityName),
                new DummyBusinessCustomSpecification($this->secondEntityName)
            );

            return $orSpec->isSatisfiedBy($element);
        };
    }
}
