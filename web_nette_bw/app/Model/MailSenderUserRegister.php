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

//    private function createMessage(): Message
//    {
//        return  new Message();
//    }
//
//    private function send(Message $message): void
//    {
////        if (!Debugger::$productionMode){
////            return;
////        }
//
////        $sender = $this->getSendmailMailer();
//        $sender = new SendmailMailer();
//        $sender->send($message);
//    }

//    private function createLatteTemplate(): Template
//    {
//        $latte = $this->templateFactory->createTemplate();
//        $latte->getLatte()->addProvider('uiControl', $this->linkGenerator);
//
//        return $latte;
//    }

    public function sendNewUserEmailVerification(array $newUser)
    {
//        $latte = $this->createLatteTemplate();
//
//        $message = $this->createMessage();
//        $message->setFrom('info@petercubon.sk')
//            ->addTo($newUser['email'])
//            ->setHtmlBody(
//                $this->createLatteTemplate()
//                    ->renderToString($this->lattePath . 'newUserVerificationMail.latte',
//                [
//                    'id'                    =>      $newUser['id'],
//                    'firstName'             =>      $newUser['surname'],
//                    'email'                 =>      $newUser['email'],
//                    'verificationCode'      =>      $newUser['verification'],
//                ]
//            ));

//        $this->send($message);

//        $mail = new Message();
//        $mail->setFrom('info@petercubon.sk')
//            ->addTo('peter.cubon@gmail.com')
//            ->setSubject('Sprava zaslana cez kontaktny formular na stránke petercubon.sk')
//            ->setHtmlBody(
//                $this->createLatteTemplate()
//                    ->renderToString($this->lattePath . 'newUserVerificationMail.latte',
//                        [
//                            'id'                    =>      $newUser['id'],
//                            'firstName'             =>      $newUser['surname'],
//                            'email'                 =>      $newUser['email'],
//                            'verificationCode'      =>      $newUser['verification'],
//                        ]
//                    ));
//
//        $mailer = new SendmailMailer();
//        $mailer->send($mail);

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

// localhost/nette/nette_bw/web_nette_bw/www/register/verification-email?verificationToken=1655142699&userId=60


    }
}