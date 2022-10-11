<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid;

interface ControlFactory
{
    public function create(
        int $deviceId,
    ): Control;
}