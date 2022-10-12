<?php

declare(strict_types=1);

namespace App\Components\Comments\DeleteComment;

use App\Core\FormFactory as CoreFormFactory;
use App\Model\CommentManager;
use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;

//use Nette\Application\UI\Multiplier;

class FormFactory
{
    public function __construct(
        private CommentManager  $commentManager,
        private CoreFormFactory $coreFormFactory,
    ) { }

    public function create($commentId): Form
    {
        $form = $this->coreFormFactory->create();

        $form->addHidden('id', 'id')
            ->setDefaultValue($commentId);
        $form->addSubmit('send', 'Odstranit komentar');

        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

    public function onSuccess(Form $form, $data)
    {
        $this->commentManager->deleteComment($data['id']);
    }

}