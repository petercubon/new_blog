<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Device;

use Nette\Application\UI\Control as NetteControl;
use Nette\Application\UI\Form;
use Nette\Security\User;

class Control extends NetteControl
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private FormFactory $formFactory,
        callable $onSuccess,
        private ?int $authorId,
        private User $user,
    ) {
        $this->onSuccess = $onSuccess;
    }

    public function render(): void
    {
        $this->template->render(__DIR__.'/default.latte');
    }

    public function createComponentForm(): Form
    {
        $form = $this->formFactory->create($this->authorId);

        $form->onSubmit[] = [$this, 'onSubmit'];
        $form->onSuccess[] = $this->onSuccess;

        return $form;
    }

    public function onSubmit(): void
    {
        $this->flashMessage('Nový spotrebič bol úspešne pridaný.', 'success');
        $this->redrawControl('flashes');
        $this->redrawControl('addDeviceForm');

    }
}