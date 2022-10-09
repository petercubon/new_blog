<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Components;
use App\Model\CommentManager;
use App\Model\DashboardManager;
use App\Model\Entity\OtherPostResource;
use App\Model\PostManager;
use App\Presenters\PostPresenter as APPostPresenter;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Security\User;

class PostPresenter extends APPostPresenter
{
    use SecurePresenterTrait;

    use Components\Post\Other\Grid\PresenterTrait;

    use Components\Post\Other\Filter\PresenterTrait;

//    private OtherPostResource $otherPostResource;

//    public function actionShow(int $postId): void
//    {
//        parent::actionShow($postId);
//
//        if($this->post->getResourceContent()->author_id !== $this->user->id){
//            $this->flashMessage('Nie si autorom tohoto clanku a nie je mozne ho zobrazit.');
//            $this->redirect('Sign:in');
//        }
//    }

    public function renderOtherByStatus(int $status): void
    {
        $this->template->posts = $this->postManager->getPostByStatus($status);
    }

}