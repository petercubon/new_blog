<?php

declare(strict_types=1);

namespace App\Components\User\Register;

use App\Model\Authenticator;
use App\Model\MailSenderUserRegister;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;

class FormFactory
{
    public function __construct(
        private Authenticator $authenticator,
        private MailSenderUserRegister $mailSenderUserRegister,
    ) { }

    public function create(): Form
    {
        $form = new Form();
        $form->addText('name', 'name')
            ->setRequired('Meno je povinný parameter.');
        $form->addText('surname', 'surname')
            ->setRequired('Priezvisko je povinný parameter.');
        $form->addEmail('email', 'email')
            ->setRequired('Email je povinný parameter.');
        $form->addPassword('password', 'password')
            ->setRequired('Heslo je povinný parameter.');
        $form->addPassword('passwordRepeat', 'passwordRepeat')
            ->setRequired('Zopakované heslo je povinný parameter.')
            ->addRule(Form::EQUAL, 'Heslá nie sú rovnaké.', $form['password']);
        $form->addCheckbox('checkbox', 'checkbox')
            ->setRequired('Súhlas je povinný parameter.');
        $form->addButton('send', 'send');

        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

    public function onSuccess(Form $form, \stdClass $data): void
    {
        // budeme hesla hashovat 2^12 (2^cost) iteracemi algoritmu bcrypt
        $password = new Passwords(PASSWORD_BCRYPT, ['cost' => 12]);

        $data = [
            'name'              =>      $data->name,
            'surname'           =>      $data->surname,
            'email'             =>      $data->email,
            'password'          =>      $password->hash($data->password),
            'verification'      =>      mt_rand(),
        ];

        $newUser = $this->authenticator->register($data);

        $this->mailSenderUserRegister->sendNewUserEmailVerification($newUser->toArray());
    }
}