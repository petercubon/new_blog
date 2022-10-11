<?php

namespace App\Components\Post\Grid;

use App\Components\Post\Grid\ControlFactory;

trait ControlTrait
{
    private ControlFactory $postGridControlFactory;
    private ?int $authorId = null;

    public function inject(ControlFactory $controlFactory)
    {
        $this->postGridControlFactory = $controlFactory;
    }

    public function createComponentPostGrid(): Control
    {
        return $this->postGridControlFactory->create(
            $this->authorId,
        );
    }

}