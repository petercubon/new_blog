<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Grid;

use App\Model\PostManager;
use Nette\Application\UI\Control as UIControl;
use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;
use Nette\Security\User;
use App\Components;
use App\Components\Post\Other\Grid\Item\ControlFactory;

class Control extends UIControl
{
    private Selection $posts;

    use Components\Post\Other\Grid\Item\PresenterTrait;

     public function __construct(
        private PostManager $postManager,
        private ControlFactory $controlFactory,
        private ?int $authorId,
        private ?int $postId,
        private User $user,
    ) {
        $this->authorId = $this->user->getId();
        $this->posts = $this->postManager->getOtherPosts($this->postId, $this->authorId);
    }

    public function render(): void
    {
        $this->template->getOtherPosts = $this->posts;
        $this->template->render(__DIR__ . '/default.latte');
    }

}