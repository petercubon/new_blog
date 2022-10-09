<?php

declare(strict_types=1);

namespace App\components\Post\Grid;

interface ControlFactory
{
    public function create(): Control;
}