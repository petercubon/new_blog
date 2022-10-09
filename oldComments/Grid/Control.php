<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid;

use App\Model\CommentManager;
use Nette\Application\UI\Control as uiControl;
use App\Components;
use App\Components\Comments\Grid\Item\ControlFactory;
use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

class Control extends uiControl
{
    use Components\Comments\Grid\Item\ControlMultipleTrait;

    public function __construct(
        private CommentManager $commentManager,
        private ?int $postId = null,
        ControlFactory $controlFactory,
    ) {
        $this->comments = $this->commentManager->getCommentById($this->postId);
        $this->injectCommentsGridItemControlFactory($controlFactory);
    }

    public function render(): void
    {
        $this->template->comments = $this->comments;
        $this->template->render(__DIR__ . '/default.latte');
    }
}