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

    private function createMessage(): Message
    {
        return  new Message();
    }

    private function send(Message $message): void
    {
        if (!Debugger::$productionMode){
            return;
        }

        $sender = $this->getSendmailMailer();
        $sender->send($message);
    }

    private function createLatteTemplate(): Template
    {
        $latte = $this->templateFactory->createTemplate();
        $latte->getLatte()->addProvider('uiControl', $this->linkGenerator);

        return $latte;
    }

    public function sendNewUserEmailVerification(array $newUser)
    {
        $latte = $this->createLatteTemplate();

        $message = $this->createMessage();
        $message->setFrom('blog@blog.com')
            ->addTo($newUser['email'])
            ->setHtmlBody(
                $this->createLatteTemplate()
                    ->renderToString($this->lattePath . 'newUserVerificationMail.latte',
                [
                    'id'                    =>      $newUser['id'],
                    'firstName'             =>      $newUser['surname'],
                    'email'                 =>      $newUser['email'],
                    'verificationCode'      =>      $newUser['verificationtoken'],
                ]
            ));

        $this->send($message);
    }
}