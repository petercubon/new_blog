<?php

declare(strict_types=1);

namespace App\Components\Comments\Add;

interface ControlFactory
{
    public function create(
        callable $onSuccess,
        ?int $postId = null,
    ): Control;
}