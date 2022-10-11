<?php

declare(strict_types=1);

namespace App\Components\Comments\Add;

use App\Model\CommentManager;
use Nette\Forms\Form;
use Nette\Application\UI\Control;

trait PresenterTrait
{
    private ControlFactory $commentAddControlFactory;
    private ?int $postId = null;

    public function injectCommentAddControlFactory(
        ControlFactory $controlFactory,
    )
    {
        $this->commentAddControlFactory = $controlFactory;
    }

    public function createComponentAddNewCommentForm(): Control
    {
        return $this->commentAddControlFactory->create(
            [$this, 'commentAddSuccess'],
            $this->postId,
        );
    }

    public function commentAddSuccess(Form $form, array $data): void
    {
        $this->flashMessage('Pridanie komentaru k clanku bolo uspesne.');
        $this->redirect('this');
    }

}