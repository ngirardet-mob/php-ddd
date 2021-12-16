<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Infrastructure\Helper\Identity\StringIdentity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyStringIdentity;
use PHPUnit\Framework\TestCase;

class StringIdentityTest extends TestCase {

    public function testFromString(): StringIdentity {
        $identity = DummyStringIdentity::fromString('plop');
        self::assertInstanceOf(StringIdentity::class, $identity);

        return $identity;
    }

    /**
     * @return void
     *
     * @depends testFromString
     */
    public function testGetId(StringIdentity $identity) {
        self::assertEquals('plop', $identity->getId());
    }

    /**
     * @return void
     *
     * @depends testFromString
     */
    public function testToString(StringIdentity $identity) {
        self::assertEquals('plop', (string)$identity);
    }
}
