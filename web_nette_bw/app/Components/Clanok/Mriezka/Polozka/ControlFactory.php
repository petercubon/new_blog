<?php

namespace App\Components\Clanok\Mriezka\Polozka;

use Nette\Database\Table\ActiveRow;

interface ControlFactory
{
    public function create(
        ActiveRow $polozka,
    ): Control;

}