<?php

namespace App\Components\User\Register;

interface ControlFactory
{
    public function create(
        callable $onSuccess
    ): Control;
}