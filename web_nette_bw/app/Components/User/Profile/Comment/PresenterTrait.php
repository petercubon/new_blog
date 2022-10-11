<?php

declare(strict_types=1);

namespace App\Components\User\Profile;

use App\Model\CommentManager;
use App\Model\PostManager;

trait PresenterTrait
{
    public function __construct(
        private CommentManager $commentManager,
        private PostManager $postManager,
        private ControlFactory $userCommentControlFactory,
    ) { }

    public function createComponentUserComment(): \Nette\Application\UI\Control
    {
        return $this->userCommentControlFactory->create();
    }
}