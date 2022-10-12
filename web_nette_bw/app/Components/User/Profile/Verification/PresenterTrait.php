<?php

namespace App\Components\User\Profile\Verification;

use App\Model\MailSenderUserRegister;
use App\Model\UserManager;

trait PresenterTrait
{
    private ControlFactory $controlFactory;
    private MailSenderUserRegister $mailSenderUserRegister;
    private UserManager $userManager;

    public function inject(
        ControlFactory $controlFactory,
        MailSenderUserRegister $mailSenderUserRegister,
        UserManager $userManager,
    )
    {
        $this->controlFactory = $controlFactory;
        $this->mailSenderUserRegister = $mailSenderUserRegister;
        $this->userManager = $userManager;
    }

    public function createComponentEmailVerificationForm(): \Nette\Application\UI\Control
    {
        return $this->controlFactory->create(
            [$this, 'onSuccess']
        );
    }

    public function onSuccess(): void
    {
        $userId = $this->user->getId();
        $verificationToken = $this->userManager->getVerificationToken($userId);

        $array = [
            'id'            => $userId,
            'verification'  => $verificationToken['verification'],
        ];

        bdump($array);

        $this->mailSenderUserRegister->sendNewUserEmailVerification($array);
    }
}