<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid\Item;

use App\Model\CommentManager;
use Nette\Application\UI\Control as uiControlItem;
use Nette\Database\Table\ActiveRow;

class Control extends uiControlItem
{

    private int $commentsForPostId;

    public function __construct(
        private CommentManager $commentManager,
        private ActiveRow $comment,
        private ?int $postId = null,
    ) { }

    public function render(): void
    {
        $this->template->comment = $this->comment;

        $this->template->render(__DIR__ . '/default.latte');
    }
}