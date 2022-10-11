<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid\Item;

use App\Model\Entity\CommentResource;
use Closure;
use Nette\Database\Table\ActiveRow;

interface ControlFactory
{
    public function create(
        CommentResource $item,
        Closure $onDelete, // callback
    ): Control;
}