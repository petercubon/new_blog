<?php

declare(strict_types=1);

namespace App\components\User\Sign\In;

use Nette\Application\UI\Control as ControlAlias;
use Nette\Application\UI\Form;

class Control extends ControlAlias
{
    private FormFactory $formFactory;
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        FormFactory $formFactory,
        callable $onSuccess = null)
    {
        $this->formFactory = $formFactory;
        $this->onSuccess = $onSuccess;
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentForm(): Form
    {
        $form = $this->formFactory->create();

        $form->onSubmit[] = [$this, 'onSubmit'];
        $form->onSuccess[] = $this->onSuccess; // registracia 2. callbacku do onSuccess

        return $form;
    }

    public function onSubmit()
    {
        $this->redrawControl('form');
    }
}