<?php

namespace App\Components\User\Profile\Verification;

use App\Model\Authenticator;
use Nette\Application\UI\Form;
use Nette\Security\User;
use stdClass;

class FormFactory
{
    public function __construct(
        private User $user,
        private Authenticator $authenticator,
    ) { }

    public function create(): Form
    {
        $form = new Form();

        $form->addButton('send', 'send');

        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

    public function onSuccess(Form $form, stdClass $data)
    {
        $userId = $this->user->getId();
        $token = mt_rand();

        $data = [
            'id'                =>  $userId,
            'verification'      =>  $token,
        ];

        return $this->authenticator->updateTokenInUserTable($data);
    }

}