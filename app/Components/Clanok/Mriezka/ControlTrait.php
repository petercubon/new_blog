<?php

declare(strict_types=1);

namespace App\Components\Clanok\Mriezka;

trait ControlTrait
{
    private ControlFactory $clanokMriezkaControlFactory;

    public function injectClanokMriezka(ControlFactory $clanokMriezkaControlFactory)
    {
        $this->clanokMriezkaControlFactory = $clanokMriezkaControlFactory;
    }

    public function createComponentClanokMriezka(): Control
    {
        return $this->clanokMriezkaControlFactory->create();
    }
}