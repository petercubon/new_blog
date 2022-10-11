<?php

namespace App\Components\Post\Detail\OtherPosts;

trait PresenterTrait
{
    private ?int $authorId = null;
    private ControlFactory $controlFactory;

    public function injectOtherPostFactory(ControlFactory $controlFactory)
    {
        $this->controlFactory = $controlFactory;
    }

    public function createComponentOtherPosts(): \Nette\Application\UI\Control
    {
        return $this->controlFactory->create(
            $this->postId,
            $this->authorId,
        );
    }

}