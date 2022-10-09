<?php

declare(strict_types=1);

namespace App\Components\User\Profile\Comment\item;

use App\Model\CommentManager;
use App\Model\PostManager;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Security\User;

class Control extends \Nette\Application\UI\Control
{
    public function __construct(
        private CommentManager $commentManager,
        private User $user,
        private ActiveRow $item,
    ) { }

    public function render(): void
    {
        $this->template->myComment = $this->item;

        $this->template->render(__DIR__ . '/default.latte');
    }

}