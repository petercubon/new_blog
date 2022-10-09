<?php

declare(strict_types=1);

namespace App\Components\Post\Manipulate;

interface ControlFactory
{
    public function create(
        callable $onSuccess,
        array $entity,
    ): Control;
}