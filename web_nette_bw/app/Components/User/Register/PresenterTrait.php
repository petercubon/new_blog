<?php

declare(strict_types=1);

namespace App\Components\User\Register;

trait PresenterTrait
{
    private ControlFactory $controlFactory;

    public function injectControlFactory(ControlFactory $controlFactory)
    {
        $this->controlFactory = $controlFactory;
    }

    public function createComponentRegisterForm(): \Nette\Application\UI\Control
    {
        return $this->controlFactory->create([
            $this, 'registerFormSuccess'
        ]);
    }

    public function registerFormSuccess(): void
    {
        $this->flashMessage('Prihlasenie bolo uspesne.');
        $this->redirect('Homepage:');
    }
}