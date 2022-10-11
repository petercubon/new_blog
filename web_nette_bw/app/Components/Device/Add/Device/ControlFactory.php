<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Device;

interface ControlFactory
{
    public function create(
        callable $onSuccess,
        ?int $authorId = null,
    ): Control;
}