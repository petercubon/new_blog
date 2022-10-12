<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Application\LinkGenerator;
use Nette\Application\UI\Template;
use Nette\Bridges\ApplicationLatte\TemplateFactory;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Tracy\Debugger;

class MailSenderUserRegister
{
    private LinkGenerator $linkGenerator;
    private TemplateFactory $templateFactory;

    public function __construct(
        LinkGenerator $linkGenerator,
        TemplateFactory $templateFactory,
        private string $lattePath,
    ) {
        $this->linkGenerator = $linkGenerator;
        $this->templateFactory = $templateFactory;
        bdump($this->lattePath);
    }

    public function sendNewUserEmailVerification(array $newUser)
    {
        $mail = new Message();
        $mail->setFrom('info@petercubon.sk')
            ->addTo('petercubon@gmail.com')
            ->setSubject('Overenie e-mailovej adresy')
            ->setHtmlBody(
                'link na overenie e-mailu: 
                     <a href="https://blog.petercubon.sk/register/verification-email?verificationToken='.$newUser['verification'].'&userId='.$newUser['id'].'">
                     overiť e-mail </a>'
            );

        $mailer = new SendmailMailer();
        $mailer->send($mail);

    }
}