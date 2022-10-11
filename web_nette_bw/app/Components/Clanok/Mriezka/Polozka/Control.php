<?php

declare(strict_types=1);

namespace App\Components\Clanok\Mriezka\Polozka;

use Nette\Database\Table\ActiveRow;

class Control extends \Nette\Application\UI\Control
{

    public function __construct(
        private ActiveRow $polozka,
    ) { }

    public function render(): void
    {
        $this->template->clanok = $this->polozka;

        $this->template->render(__DIR__.'/default.latte');
    }

}