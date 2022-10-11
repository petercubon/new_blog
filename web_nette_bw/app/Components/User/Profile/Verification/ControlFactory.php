<?php

namespace App\Components\User\Profile\Verification;

interface ControlFactory
{
    public function create(
        callable $onSuccess,
    ): Control;
}