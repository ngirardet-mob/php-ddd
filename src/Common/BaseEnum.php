<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common;

use InvalidArgumentException;
use ReflectionClass;

    /**
     * Trait BaseEnum
     *
     * @see     https://www.webfactory.de/blog/expressive-type-checked-constants-for-php
     * @note    Waiting to evolve to php 8.1 for enum support
     */
trait BaseEnum {
    private static array $instances = [];

    private string|int $value;

    /**
     * ConstantClassTrait constructor.
     *
     * @param string|integer $value Literal value of the constant
     */
    final private function __construct(string|int $value) {
        $this->value = $value;
    }

    /**
     * Create an instance of a constant
     *
     * @param string|integer $value Literal value of the constant
     *
     * @return static
     */
    private static function constant(string|int $value): static {
        if (!isset(self::$instances[$value])) {
            self::$instances[$value] = new self($value);
        }

        return self::$instances[$value];
    }

    /**
     * Stringify the value
     *
     * @return string
     */
    public function __toString(): string {
        return (string)$this->value;
    }

    /**
     * Create or return the unique instance of an Enum object if the value is an existing constant value.
     *
     * @param int|string $value Constant value
     *
     * @return self
     */
    public static function fromValue(int|string $value): static {
        $reflection = new ReflectionClass(self::class);
        $constantValues = array_map(
            function ($constant) use ($reflection) {
                return $reflection->getConstant($constant->getName());
            },
            $reflection->getReflectionConstants()
        );
        if (!in_array($value, $constantValues)) {
            throw new InvalidArgumentException(sprintf("Invalid value '%s' for constant class %s", $value, self::class));
        }

        return self::constant($value);
    }
}
