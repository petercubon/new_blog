<?php

declare(strict_types=1);

namespace App\Components\Comments\Add;

use Nette\Application\UI\Form;

class Control extends \Nette\Application\UI\Control
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private FormFactory $formFactory,
        callable $onSuccess = null,
        private ?int $postId = null,
    )
    {
        $this->onSuccess = $onSuccess;
    }

    public function render():void
    {
        $this->template->render(__DIR__.'/default.latte');
    }

    public function createComponentAddCommentForm(): Form
    {
        $form = $this->formFactory->create($this->postId);

        $form->onSubmit[] = [$this, 'onSubmit']; // zavola prekreslenie formularu po AJAX requeste
        $form->onSuccess[] = $this->onSuccess; // registracia 2. callbacku

        return $form;
    }

    public function onSubmit(): void
    {
        $this->redrawControl('form');
    }

}