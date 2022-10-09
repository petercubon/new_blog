<?php

declare(strict_types=1);

namespace App\Components\Clanok\Mriezka\Polozka;

use Nette\Database\Table\ActiveRow;

trait ControlOneTrait
{
    private ControlFactory $clanokMriezkaPolozkaControlFactory;
    private ActiveRow $clanokMriezkaPolozka;

    public function injectClanokMriezkaPolozkaControlFactory(ControlFactory $clanokMriezkaPolozkaControlFactory)
    {
        $this->clanokMriezkaPolozkaControlFactory = $clanokMriezkaPolozkaControlFactory;
    }

    public function createComponentClanokMriezkaPolozka(): Control
    {
        return $this->clanokMriezkaPolozkaControlFactory->create($this->clanokMriezkaPolozka);
    }
}