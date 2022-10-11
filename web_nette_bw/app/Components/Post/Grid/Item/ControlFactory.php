<?php

namespace App\Components\Post\Grid\Item;

use Nette\Database\Table\ActiveRow;

interface ControlFactory
{

    public function create(
        ActiveRow $item,
    ): Control;

}