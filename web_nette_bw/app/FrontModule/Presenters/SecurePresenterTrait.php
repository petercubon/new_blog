<?php

namespace App\FrontModule\Presenters;

use App\Model\RoleManager;

trait SecurePresenterTrait
{
    protected function startup()
    {
        if (!$this->isLinkCurrent('Sign:in') && !$this->user->isAllowed('front', 'view')){

            $this->flashMessage('Na pristup do tejto sekcie nemas opravnenie.', 'error');
            $this->redirect('Sign:in');
        }

        parent::startup();
    }
}