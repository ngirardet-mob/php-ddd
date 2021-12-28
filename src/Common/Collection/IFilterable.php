<?php
/**
 * Author: ngirardet
 * Date: 25.12.2021
 * Description:
 */

namespace Ngirardet\PhpDdd\Common\Collection;

use Ngirardet\PhpDdd\Common\Specification\ISpecification;

interface IFilterable {
    public function filter(ISpecification $specification): GenericCollection;
}
