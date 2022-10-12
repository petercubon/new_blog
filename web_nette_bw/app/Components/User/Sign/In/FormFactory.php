<?php

declare(strict_types=1);

namespace App\components\User\Sign\In;

use App\Core\FormFactory as CoreFormFactory;
use Exception;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;
use stdClass;

class FormFactory
{
    public function __construct(
        private User $user,
        private CoreFormFactory $coreFormFactory,
    ) { }

    public function create(): Form
    {
        $form = $this->coreFormFactory->create();

        $form->addEmail('email', 'E-mailova adresa')
            ->setRequired('Nezadali ste uzivatelske meno!');
        $form->addPassword('password', 'Heslo')
            ->setRequired('Nezadali ste heslo!');
        $form->addSubmit('login', 'Prihlasit');

        $form->onSuccess[] = [$this, 'onSuccess']; // pri vytvoreni formularu sa registuje 1. callback

        return $form; // nasledne sa vrati $form do SignPresenteru
    }

    public function onSuccess(Form $form, stdClass $values): void
    {
        try {
            $this->user->login($values->email, $values->password);
        }
        catch (Exception $e) {
            $form->addError('Nespravne zadane prihlasovacie udaje.');
        }
    }
}