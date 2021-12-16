<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Infrastructure\Helper\Identity\IntegerIdentity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyIntegerIdentity;
use PHPUnit\Framework\TestCase;

class IntegerIdentityTest extends TestCase {

    public function testFromInt() {
        $identity = DummyIntegerIdentity::fromInt(2);
        self::assertInstanceOf(IntegerIdentity::class, $identity);

        return $identity;
    }

    /**
     * @return void
     *
     * @depends testFromInt
     */
    public function testGetId(IntegerIdentity $identity) {
        self::assertEquals(2, $identity->getId());
    }
}
