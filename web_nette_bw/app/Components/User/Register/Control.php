<?php

declare(strict_types=1);

namespace App\Components\User\Register;

use Nette\Application\UI\Form;

class Control extends \Nette\Application\UI\Control
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        callable $onSuccess,
        private FormFactory $formFactory,
    ) {
        $this->onSuccess = $onSuccess;
    }

    public function render()
    {
        $this->template->render(__DIR__.'/default.latte');
    }

    public function createComponentForm(): Form
    {
        $form = $this->formFactory->create();

        $form->onSuccess[] = $this->onSuccess; // registracia 2. callbacku do onSuccess

        return $form;
    }
}