<?php

declare(strict_types=1);

namespace App\Components\User\Profile;

interface ControlFactory
{
    public function create(): Control;
}