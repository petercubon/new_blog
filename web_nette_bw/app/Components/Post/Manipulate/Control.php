<?php

declare(strict_types=1);

namespace App\Components\Post\Manipulate;

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
        private array $entity = [],
    )
    {
        $this->onSuccess = $onSuccess;
    }

    public function render(): void
    {
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentPostForm(): Form
    {
        $form = $this->formFactory->create($this->entity);

        $form->onSubmit[] = [$this, 'onSubmit'];
        $form->onSuccess[] = $this->onSuccess; // registracia 2. callbacku

        return $form;
    }

    public function onSubmit(): void
    {
        $this->redrawControl('form');
    }
}