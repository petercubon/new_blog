<?php

declare(strict_types=1);

namespace App\Components\Post\Grid\Item;

use Nette\Database\Table\ActiveRow;

trait ControlOneTrait
{

    private ControlFactory $postGridItemControlFactory;
    private ActiveRow $postGridItem;

    public function inject(ControlFactory $controlFactory)
    {
        $this->postGridItemControlFactory = $controlFactory;
    }

    public function createComponentPostGridItem(): Control
    {
        return $this->postGridItemControlFactory->create($this->postGridItem);
    }

}