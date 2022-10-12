<?php

declare(strict_types=1);

namespace App\Components\Comments\DeleteComment;

use Nette\Application\UI\Form;
use Nette\Application\UI\Multiplier;

class Control extends \Nette\Application\UI\Control
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private FormFactory $formFactory,
        callable $onSuccess,
        private $commentId,
    )
    {
        $this->onSuccess = $onSuccess;
    }


    public function render():void
    {
        $this->template->render(__DIR__.'/default.latte');
    }


    //  Component form pre delete comment
    public function createComponentForm(): Form
    {
        $form = $this->formFactory->create($this->commentId);

        $form->onSuccess[] = [$this->onSuccess];

        return $form;
    }


}