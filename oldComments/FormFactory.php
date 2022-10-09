<?php

declare(strict_types=1);

namespace App\components\Comments;

use App\Core\FormFactory as CoreFormFactory;
use App\Model\CommentManager;
use Nette\Application\UI\Form;

class FormFactory
{
    public function __construct(
        private CommentManager   $commentManager,
        private CoreFormFactory $coreFormFactory,
    ) {}

    // Component for new Commentar
    public function create($postId): Form
    {
        $form = $this->coreFormFactory->create();

        $form->addText('name', 'meno');
        $form->addText('email', 'email');
        $form->addInteger('postId', 'postId')
        ->setDefaultValue($postId);
        $form->addText('content', 'content');
        $form->addSubmit('send', 'send');

        $form->onSuccess[] = [$this, 'onSuccessAddComment'];

        return $form;
    }

    // OnSuccess Method for addNewCommnet
    public function onSuccessAddComment(Form $form, $data)
    {
        $this->commentManager->insertComment($data);
    }
}