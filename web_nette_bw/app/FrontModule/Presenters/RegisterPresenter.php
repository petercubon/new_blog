<?php

namespace App\FrontModule\Presenters;

use App\Components\User\Register\PresenterTrait;
use App\Model\Authenticator;
use App\Model\MailSenderUserRegister;
use App\Model\UserManager;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use Nette\Utils\ArrayHash;

class RegisterPresenter extends \App\Presenters\SignPresenter
{
    use SecurePresenterTrait;

    use PresenterTrait;

    /** @var Passwords */
    private $passwords;

    public function __construct(
        private Authenticator $authenticator,
        Passwords $passwords,
        private MailSenderUserRegister $mailSenderUserRegister,
        private UserManager $userManager,
    ) { }

    public function onSuccessRegisterForm(): void
    {
        $this->redirect('homepage:default');
    }

    public function actionVerificationEmail(string $verificationToken, int $userId)
    {
        $checkIfExistUserId = $this->userManager->checkIfUserExist($userId);

        if (!$checkIfExistUserId){
            $this->error('Pouzivatel neexistuje', 404);
        }

        $data = $this->userManager->getVerificationToken($userId);

        $userVerificationToken = $data['verification'];
        $register_date = strtotime($data['register_date']);

        $currentTime = strtotime(date('Y-m-d H:i:s'));
        $interval = ($currentTime - $register_date) / 60;

        if ($interval < 15 && $userVerificationToken == $verificationToken){
            $this->userManager->setUserVerificationStatus($userId);
            $this->redirect('Register:EmailTrue');
        } else {
            $this->redirect('Register:EmailFalse');
        }
    }

}