<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Domain\Entity\IIdentity;

/**
 * Identity composed of multiple values
 *
 * @template T
 * @template-implements IIdentity
 */
abstract class CompositeIdentity implements IIdentity {
    /**
     * Private constructor
     * @param array $id
     */
    private function __construct(protected array $id) {}

    /**
     * Exposes composite identity
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * Construct identity from an array
     * @param array $id
     *
     * @return static
     */
    public static function fromArray(array $id): static {
        return new static($id);
    }
}
