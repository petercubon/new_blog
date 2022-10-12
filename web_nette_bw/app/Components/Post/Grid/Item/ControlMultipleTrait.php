<?php

declare(strict_types=1);

namespace App\Components\Post\Grid\Item;

use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

trait ControlMultipleTrait
{

    private ControlFactory $postGridItemControlFactory;

    public function inject(ControlFactory $controlFactory)
    {
        $this->postGridItemControlFactory = $controlFactory;
    }

    public function createComponentPostGridItemMultiple()
    {
        $manager = $this->postManager;
        $factory = $this->postGridItemControlFactory;

        return new Multiplier(function (string $id) use ($manager, $factory) {
            return $factory->create($manager->getById((int) $id));
        });
    }

}