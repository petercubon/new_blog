<?php

declare(strict_types=1);

namespace App\Components\Clanok\Mriezka\Polozka;

use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

trait ControlMultipleTrait
{
    private ControlFactory $clanokMriezkaPolozkaControlFactory;
    private Selection $clanky;

    public function injectClanokMriezkaPolozkaControlFactory(ControlFactory $clanokMriezkaPolozkaControlFactory)
    {
        $this->clanokMriezkaPolozkaControlFactory = $clanokMriezkaPolozkaControlFactory;
    }

    public function createComponentClanokMriezkaPolozkaMultiple()
    {
        $clanky = $this->clanky;
        $factory = $this->clanokMriezkaPolozkaControlFactory;

        return new Multiplier(function (string $id) use ($clanky, $factory){
            return $factory->create($clanky[(int) $id]);
        });
    }


}