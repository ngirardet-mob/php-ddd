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
        self::assertInstanceOf(DummyEnum::class, DummyEnum::SOME_CONST());
    }

    public function testEnumStringValue() {
        self::assertEquals('Some string value', (string)DummyEnum::SOME_CONST());
        self::assertEquals('2', (string)DummyEnum::SOME_OTHER_CONST());
    }

    public function testEnumFromValue() {
        self::assertSame(DummyEnum::SOME_OTHER_CONST(), DummyEnum::fromValue(2));
        self::assertSame(DummyEnum::SOME_CONST(), DummyEnum::fromValue('Some string value'));
    }

    public function testEnumUnexpectedValue() {
        self::expectException(InvalidArgumentException::class);
        DummyEnum::fromValue('Unexpected value');
    }
}
