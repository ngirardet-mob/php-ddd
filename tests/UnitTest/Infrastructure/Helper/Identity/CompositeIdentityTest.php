<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\UnitTest\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Infrastructure\Helper\Identity\CompositeIdentity;
use Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity\DummyCompositeIdentity;
use PHPUnit\Framework\TestCase;

class CompositeIdentityTest extends TestCase {

    public function testFromArray(): DummyCompositeIdentity {
        $sut = DummyCompositeIdentity::fromArray(['key' => 'value']);
        self::assertInstanceOf(CompositeIdentity::class, $sut);

        return $sut;
    }

    /**
     * @depends testFromArray
     * @return void
     */
    public function testToArray(DummyCompositeIdentity $sut) {
        self::assertEquals(['key' => 'value'], $sut->toArray());
    }
}
