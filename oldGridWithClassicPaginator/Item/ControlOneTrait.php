<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid\Item;

use Nette\Database\Table\ActiveRow;

trait ControlOneTrait
{
    private ControlFactory $commentsGridItemControlFactory;
    private ActiveRow $commentGridItem;
    private ?int $postId = null;

    public function injectCommentsGridItemControlFactory(ControlFactory $controlFactory)
    {
        $this->commentsGridItemControlFactory = $controlFactory;
    }

    public function createComponentCommentsGridItem(): Control
    {
        return $this->commentsGridItemControlFactory->create(
            $this->commentGridItem,
            $this->postId,
        );
    }
}