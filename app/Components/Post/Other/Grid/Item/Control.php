<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Grid\Item;

use App\Model\PostManager;
use Nette\Application\UI\Control as UIControl;
use Nette\Database\Table\ActiveRow;

class Control extends UIControl
{
    public function __construct(
        private ActiveRow $item,
        private PostManager $postManager,
    ) { }

    public function render(): void
    {
        $this->template->post = $this->item;
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function handledeleteOtherPost(int $postId): void
    {
        $this->postManager->delete($postId);
        $this->flashMessage('Zmazanie článku bolo úspešné', 'success');
        $this->redrawControl('flashes');
        $this->getPresenter()->redirect('this');
    }

}