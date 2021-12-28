<?php
/**
 * Author: ngirardet
 * Date: 25.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common\Collection;

interface IListable {
    public function toList(): array;
}
