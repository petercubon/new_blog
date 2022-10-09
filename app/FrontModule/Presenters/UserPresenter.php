<?php

declare(strict_types=1);

namespace App\FrontModule\Presenters;

use App\Components;
use App\Model\CommentManager;
use App\Model\PostManager;

class UserPresenter extends \Nette\Application\UI\Presenter
{
    use Components\User\Profile\PresenterTrait;

    public function actionDefault(): void
    {
        $this->template->status = $this->user->getIdentity()->status;
    }
}