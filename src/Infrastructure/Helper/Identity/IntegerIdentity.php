<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Domain\Entity\IIdentity;

/**
 * Numeric identity
 * @template T
 * @template-implements IIdentity<T>
 */
abstract class IntegerIdentity implements IIdentity {
    /**
     * Constructor
     * @param int $id
     */
    private function __construct(protected int $id) {}

    /**
     * Id getter
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Create ID from integer
     * @param int $id
     *
     * @return static
     */
    public static function fromInt(int $id): static {
        return new static($id);
    }
}
