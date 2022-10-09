<?php

declare(strict_types=1);

namespace App\components\Post\Grid\Item;

use App\Model\PostManager;
use Nette\Application\UI\Control as ControlAlias;
use Nette\Database\Table\ActiveRow;

class Control extends ControlAlias
{
//    private PostManager $postManager;

    public function __construct(
        private PostManager $postManager,
        private ActiveRow $item,
    ) {
//        $this->postManager = $this->postManager;
    }

    public function render(): void
    {
        $this->template->post = $this->item;

        $this->template->render(__DIR__ . '/default.latte');
    }

}