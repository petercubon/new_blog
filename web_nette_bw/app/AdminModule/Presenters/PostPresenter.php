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

    public function renderOtherByStatus(int $status): void
    {
        $this->template->posts = $this->postManager->getPostByStatus($status);
    }

}