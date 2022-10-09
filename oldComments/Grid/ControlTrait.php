<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid;

trait ControlTrait
{
    private ControlFactory $commentsGridControlFactory;
    private ?int $postId = null;

    public function injectCommentsGridControlFactory(ControlFactory $controlFactory)
    {
        $this->commentsGridControlFactory = $controlFactory;
    }

    public function createComponentCommentsGrid(): Control
    {
        return $this->commentsGridControlFactory->create(
            $this->postId,
        );
    }
}