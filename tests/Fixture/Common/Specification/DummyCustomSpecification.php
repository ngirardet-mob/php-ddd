<?php
/**
 * Author: ngirardet
 * Date: 15.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Common\Specification;

use Ngirardet\PhpDdd\Common\Specification\BaseSpecification;
use Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity;

/**
 * @method isSatisfiedBy(DummyEntity $element)
 * @template-implements BaseSpecification<\Ngirardet\PhpDdd\Test\Fixture\Domain\Entity\DummyEntity>
 */
class DummyCustomSpecification extends BaseSpecification {
    public function __construct(private string $entityName) {}

    /**
     * @param DummyEntity $element
     *
     * @return callable
     */
    protected function getSpecExpression(mixed $element): callable {
        return fn () => $element->getName() === $this->entityName;
    }
}
