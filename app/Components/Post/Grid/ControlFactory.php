<?php

namespace App\Components\Post\Grid;

interface ControlFactory
{

    public function create(
        ?int $authorId,
    ): Control;

}