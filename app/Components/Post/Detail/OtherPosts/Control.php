<?php

declare(strict_types=1);

namespace App\Components\Post\Detail\OtherPosts;

use App\Model\PostManager;
use Nette\Security\User;

class Control extends \Nette\Application\UI\Control
{
    public function __construct(
        private PostManager $postManager,
        private ?int $postId,
        private ?int $authorId,
        private User $user,
    ) {
        $this->authorId = $this->user->getId();
    }

    public function render()
    {
        $this->template->otherPosts = $this->postManager->getOtherPosts($this->postId, $this->authorId);

        $this->template->render(__DIR__ . '/default.latte');
    }

}