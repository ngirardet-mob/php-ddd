<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Common;

use InvalidArgumentException;
use Ngirardet\PhpDdd\Test\Fixture\Common\DummyEnum;
use PHPUnit\Framework\TestCase;

class DummyEnumTest extends TestCase {
    public function testEnumInstance() {
        self::assertInstanceOf(DummyEnum::class, DummyEnum::SOME_STRING_CONST());
    }

    public function testEnumValueType() {
        self::assertEquals('Some string value', (string)DummyEnum::SOME_STRING_CONST());
        self::assertEquals(2, (int)(string)DummyEnum::SOME_INTEGER_CONST());
        self::assertEquals(7.7, (float)(string)DummyEnum::SOME_FLOAT_CONST());
        self::assertEquals(0x178, (string)DummyEnum::SOME_HEXADECIMAL_CONST());
    }

    public function testEnumFromValue() {
        self::assertSame(DummyEnum::SOME_INTEGER_CONST(), DummyEnum::fromValue(2));
        self::assertSame(DummyEnum::SOME_STRING_CONST(), DummyEnum::fromValue('Some string value'));
        self::assertSame(DummyEnum::SOME_FLOAT_CONST(), DummyEnum::fromValue(7.7));
        self::assertSame(DummyEnum::SOME_HEXADECIMAL_CONST(), DummyEnum::fromValue(0x178));
    }

    public function testEnumUnexpectedValue() {
        self::expectException(InvalidArgumentException::class);
        DummyEnum::fromValue('Unexpected value');
    }
}
