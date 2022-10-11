<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Grid;

use App\Model\Entity\OtherPostResource;
use App\Model\PostManager;

trait PresenterTrait
{
    private ControlFactory $postOtherGridControlFactory;
    private PostManager $postManager;

    public function inject(
        ControlFactory $controlFactory,
        PostManager $postManager,)
    {
        $this->postOtherGridControlFactory = $controlFactory;
        $this->postManager = $postManager;
    }

    public function createComponentOtherPostGrid (): Control
    {
        return $this->postOtherGridControlFactory->create();
    }
    
}