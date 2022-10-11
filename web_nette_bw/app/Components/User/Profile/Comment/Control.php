<?php

declare(strict_types=1);

namespace App\Components\User\Profile;

use App\Model\CommentManager;
use App\Model\PostManager;
use Nette\Application\UI\Multiplier;
use Nette\Security\User;

class Control extends \Nette\Application\UI\Control
{
//    use \App\Components\User\Profile\Comment\item\PresenterTrait;

    public function __construct(
        private CommentManager $commentManager,
        private User $user,
        private \App\Components\User\Profile\Comment\item\ControlFactory $controlFactory,
    ) { }

    public function render(): void
    {
        $userId = $this->user->getId();

        $this->template->comment = $this->commentManager->getCommentByUserId($userId);

        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentUserComment()
    {
        $manager = $this->commentManager;
        $factory = $this->controlFactory;

        return new Multiplier(function (string $id) use ($manager, $factory){
            return $factory->create($manager->getUserComment((int) $id));
        });
    }

}