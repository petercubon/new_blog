<?php

namespace App\Components\User\Profile\Verification;

use Nette\Application\UI\Form;

class Control extends \Nette\Application\UI\Control
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private FormFactory $formFactory,
        callable $onSuccess,
    ) {
        $this->onSuccess = $onSuccess;
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentForm($data): Form
    {
        $form = $this->formFactory->create();

        $form->onSuccess[] = $this->onSuccess;

        return $form;
    }

}