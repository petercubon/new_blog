<?php

declare(strict_types=1);

namespace App\Presenters;

use App\components;
use Nette\Application\UI\Presenter;

abstract class SignPresenter extends Presenter
{
    use components\User\Sign\In\PresenterTrait;

    public function actionOut()
    {
        $this->user->logout(true);
        $this->flashMessage('Odhlasenie bolo uspesne', 'success');
        $this->redirect('Homepage:');
    }

}