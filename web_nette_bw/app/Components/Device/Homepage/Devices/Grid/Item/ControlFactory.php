<?php

namespace App\Components\Device\Homepage\Devices\Grid\Item;

use App\Model\Entity\DeviceResource;
use Closure;

interface ControlFactory
{
    public function create(
        DeviceResource $item,
        Closure $onDelete,
    ): Control;
}