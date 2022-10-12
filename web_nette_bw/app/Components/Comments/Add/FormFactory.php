<?php

declare(strict_types=1);

namespace App\Components\Comments\Add;

use App\Core\FormFactory as FormFactoryCore;
use App\Model\CommentManager;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\SmartObject;

class FormFactory
{
    use SmartObject;

    private ?int $postId = null;

    public function __construct(
        private CommentManager   $commentManager,
        private FormFactoryCore $coreFormFactory,
        private User $user,
    ) { }

    public function create(int $postId = null): Form
    {
        $this->postId = $postId;

        $form = $this->coreFormFactory->create();

        $form->addText('name', 'meno')
        ->setRequired('Pre pridanie komentaru zadaj meno.');
        $form->addText('email', 'email');
        $form->addText('content', 'content')
        ->setRequired('Text komentaru je povinne pole.');
        $form->addSubmit('send', 'send');
        $form->onSuccess[] = [$this, 'onSuccessAddComment'];

        return $form;
    }

    // OnSuccess Method for addNewCommnet
    public function onSuccessAddComment(Form $form, array $data)
    {
        $data['postId'] = $this->postId;
        $data['author_id'] = $this->user->id;

        $this->commentManager->insertComment($data);
    }

}