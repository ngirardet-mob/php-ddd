<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Domain\Entity\IIdentity;

/**
 * String identity
 */
abstract class StringIdentity implements IIdentity {
    /**
     * Constructor
     * @param string $id
     */
    private function __construct(protected string $id) {}

    /**
     * ID getter. Shorthand for getId
     * @return string
     */
    public function __toString(): string {
        return $this->getId();
    }

    /**
     * ID getter.
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }

    /**
     * Create ID from string
     * @param string $id
     *
     * @return static
     */
    public static function fromString(string $id): static {
        return new static($id);
    }
}
