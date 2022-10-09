<?php

namespace App\components\Post\Grid\Item;

use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

trait ControlMultipleTrait
{
    private ControlFactory $postGridItemControlFactory; // inject z Post/GridItem/ControlFactory
    private Selection $posts;

    public function injectPostGridItemControlFactory(ControlFactory $controlFactory) // inject ControlFactory
    {
        $this->postGridItemControlFactory = $controlFactory;
    }

    public function createComponentPostGridItemMultiple()
    {
        $posts = $this->posts;
        $factory = $this->postGridItemControlFactory;

        return new Multiplier(function (string $id) use ($posts, $factory){
            return $factory->create($posts[(int) $id]);
        });
    }
}