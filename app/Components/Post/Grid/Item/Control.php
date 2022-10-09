<?php

declare(strict_types=1);

namespace App\Components\Post\Grid\Item;

use Nette\Application\UI\Control as ControlAlias;
use Nette\Database\Table\ActiveRow;

class Control extends ControlAlias
{

    public function __construct(
        private ActiveRow $item,
    ) { }

    public function render(): void
    {
        $this->template->post = $this->item;

        $this->template->render(__DIR__ . '/default.latte');
    }

}