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

    private const SOME_STRING_VALUE = 'Some string value';
    private const SOME_INTEGER_VALUE = 2;
    private const SOME_FLOAT_VALUE = 7.7;
    private const SOME_HEXADECIMAL_VALUE = 0x178;

    public static function SOME_STRING_CONST(): DummyEnum {
        return self::constant(self::SOME_STRING_VALUE);
    }

    public static function SOME_INTEGER_CONST(): DummyEnum {
        return self::constant(self::SOME_INTEGER_VALUE);
    }

    public static function SOME_FLOAT_CONST(): DummyEnum {
        return self::constant(self::SOME_FLOAT_VALUE);
    }

    public static function SOME_HEXADECIMAL_CONST(): DummyEnum {
        return self::constant(self::SOME_HEXADECIMAL_VALUE);
    }
}
