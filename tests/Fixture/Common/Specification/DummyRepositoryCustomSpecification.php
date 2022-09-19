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
class DummyRepositoryCustomSpecification extends BaseSpecification {
    public function __construct(private string $entityName) {}

    /**
     * @param array $element Dummy entity saved in the repository memory as array
     *
     * @return callable
     */
    protected function getSpecExpression(mixed $element): callable {
        return fn () => $element['name'] === $this->entityName;
    }
}
