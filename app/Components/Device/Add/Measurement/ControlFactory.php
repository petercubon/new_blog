<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Measurement;

interface ControlFactory
{
    public function create(
        callable $onSuccess,
        int $measurementId,
        int $deviceId,
        string $deviceName,
    ): Control;
}