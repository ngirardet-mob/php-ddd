<?php
/**
 * Author: ngirardet
 * Date: 13.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Test\Fixture\Infrastructure\Helper\Identity;

use Ngirardet\PhpDdd\Infrastructure\Helper\Identity\CompositeIdentity;

/**
 * @implements CompositeIdentity
 */
class DummyCompositeIdentity extends CompositeIdentity {

    /**
     * @inheritDoc
     */
    public function toArray(): array {
        return $this->id;
    }
}
