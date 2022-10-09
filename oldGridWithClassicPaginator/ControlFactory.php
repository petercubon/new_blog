<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid;

interface ControlFactory
{
    public function create(
        ?int $postId = null,
    ): Control;
}