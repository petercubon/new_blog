<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid\Item;

use App\Model\CommentManager;
use App\Model\Entity\CommentResource;
use Closure;
use Nette\Application\UI\Control as uiControlItem;
use Nette\Security\User;

class Control extends uiControlItem
{
    public function __construct(
        private CommentResource $item,
        private Closure $onDelete, // callback
        private CommentManager $manager,
        private User $user,
    ) { }

    public function render(): void
    {
        $this->template->item = $this->item;
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function handleDelete(): void
    {
        $isAllowedToDeleteThis = $this->user->isAllowed($this->item, 'delete');

        if ($isAllowedToDeleteThis){
            $this->manager->delete($this->item->id);
        }

        ($this->onDelete)($isAllowedToDeleteThis);
    }
}