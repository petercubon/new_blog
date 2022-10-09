<?php

declare(strict_types=1);

namespace App\Components\User\Profile\Comment\item;

use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

interface ControlFactory
{
    public function create(
        ActiveRow $item,
    ): Control;
}