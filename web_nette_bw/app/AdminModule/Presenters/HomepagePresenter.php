<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components\Post\Detail\OtherPosts\Control;
use App\Components\Post\Detail\OtherPosts\ControlFactory;
use App\Components\Post\Grid\ControlTrait as ComponentsPostGridControlTrait;
use App\Model\Authenticator;
use App\Model\PostManager;
use Nette\Database\Explorer;
use Nette\Security\User;

class HomepagePresenter extends BasePresenter
{
    use ComponentsPostGridControlTrait;

    //    private ?int $authorId = null;
//
//    public function actionDefault(): void
//    {
//        $this->authorId = $this->user->id;
//    }

    public function __construct(
        private PostManager $postManager,
        private User $user,
        private Explorer $db,
        private Authenticator $authenticator,
    ) { }

    public function renderDefault()
    {
        $this->template->numOfPublicPosts = $this->postManager->getCountOfPublicPosts();
        $this->template->numOfConceptPosts = $this->postManager->getConceptOfPosts();
        $this->template->numOfIdeaPosts = $this->postManager->getWaitingPosts();
    }

}
