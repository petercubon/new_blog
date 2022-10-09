<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid\Item;

use Nette\Database\Table\ActiveRow;

interface ControlFactory
{
    public function create(
        ActiveRow $comment,
        ?int $postId = null,
    ): Control;
}