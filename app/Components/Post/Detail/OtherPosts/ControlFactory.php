<?php

declare(strict_types=1);

namespace App\Components\Post\Detail\OtherPosts;

interface ControlFactory
{
    public function create(
        ?int $postId,
        ?int $authorId,
    ): Control;
}