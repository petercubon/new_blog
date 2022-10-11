<?php

namespace App\Components\Device\Homepage\Devices\Grid;

interface ControlFactory
{
    public function create(
        ?int $authorId,
    ): Control;
}