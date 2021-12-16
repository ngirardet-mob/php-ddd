<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Common\Specification;

use Ngirardet\PhpDdd\Common\Specification\AndSpecification;
use Ngirardet\PhpDdd\Common\Specification\BaseSpecification;
use Ngirardet\PhpDdd\Common\Specification\NotSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;

/**
 * @template-implements BaseSpecification<\Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity>
 * @method isSatisfiedBy(DummyEntity $element)
 */
class DummyNotSpecification extends BaseSpecification {

    public function __construct(private string $entityName) {}

    /**
     * @param \Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity $element
     *
     * @return callable
     */
    protected function getSpecExpression(mixed $element): callable {
        return function () use ($element): bool {
            $notSpec = new NotSpecification(
                new DummyCustomSpecification($this->entityName)
            );

            return $notSpec->isSatisfiedBy($element);
        };
    }
}
