<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Grid;

interface ControlFactory
{
    public function create(): Control;
}