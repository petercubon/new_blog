<?php

declare(strict_types=1);

namespace App\components\User\Sign\In;

use Nette\Application\UI\Control;

trait PresenterTrait
{
    private ControlFactory $userSignInControlFactory; // inject formularu z User/Sign/In/FormFactory
    private string $storeRequestId = '';

    public function injectUserSignInControlFactory(ControlFactory $controlFactory) // inject ControlFactory
    {
        $this->userSignInControlFactory = $controlFactory;
    }

    public function createComponentSignInForm(): Control
    {
        return $this->userSignInControlFactory->create([$this, 'onSignInFormSuccess']);
    }

    public function onSignInFormSuccess(): void
    {
        $this->flashMessage('Prihlasenie bolo uspesne.');
//        $this->restoreRequest($this->storeRequest);
//        $this->redirect('Dashboard:default');
        $this->redirect('Homepage:');
    } // tato metoda sa vykona za predpokladu, ze nenastala chyba vo FormFactory a jej metode onSuccess


}