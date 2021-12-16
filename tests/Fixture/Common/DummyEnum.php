<?php
/**
 * Author: ngirardet
 * Date: 14.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Common;

use Ngirardet\PhpDdd\Common\BaseEnum;

class DummyEnum {
    use BaseEnum;

    private const SOME_CONST = 'Some string value';
    private const SOME_OTHER_CONST = 2;

    public static function SOME_CONST(): DummyEnum {
        return self::constant(self::SOME_CONST);
    }

    public static function SOME_OTHER_CONST(): DummyEnum {
        return self::constant(self::SOME_OTHER_CONST);
    }
}
