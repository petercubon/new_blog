<?php

namespace App\components\Post\Grid\Item;

use App\components\Post\GridItem\ControlFactory;
use Nette\Database\Table\ActiveRow;

trait ControlOneTrait
{
    private ControlFactory $postGridItemControlFactory; // inject z Post/GridItem/ControlFactory
    private ActiveRow $postGridItem;

//    public function __construct(ControlFactory $postGridItemControlFactory)
//    {
//        $this->postGridItemControlFactory = $postGridItemControlFactory;
//    }

    public function injectPostGridItemControlFactory(ControlFactory $controlFactory) // inject ControlFactory
    {
        $this->postGridItemControlFactory = $controlFactory;
    }

    public function createComponentPostGridItem(): Control
    {
        return $this->postGridItemControlFactory->create($this->postGridItem);
    }
}