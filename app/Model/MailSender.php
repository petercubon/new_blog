<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Application\LinkGenerator;
use Nette\Application\UI\Link;
use Nette\Application\UI\Template;
use Nette\Application\UI\TemplateFactory;
use Nette\Database\Explorer;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Tracy\Debugger;

class MailSender
{
    public function __construct(
        private TemplateFactory $templateFactory,
        private LinkGenerator $linkGenerator,
        // $lattePath je nastavena v common.neon
        private string $lattePath,
        private SettingManager $settingManager,
    ) { }

    private function createMessage(): Message
    {
        // nie je potreba new Message() extrahovat do tovarnicky, pouziva sa iba v tejto funkcii
        $message = new Message();

        $message->setFrom($this->settingManager->emailSender);
        $message->addTo($this->settingManager->emailReceiver);

        return $message;

    }

    private function send(Message $message): void
    {
        $sender = new SendmailMailer();
        $sender->send($message);
    }

    private function createLatteTemplate(): Template
    {
        // aby bolo mozne nacitat latte a pouzivat linky <a n:href="..."> ... </a>
        $latte = $this->templateFactory->createTemplate();
        $latte->getLatte()->addProvider('uiControl', $this->linkGenerator);

        return $latte;
    }

    public function sendPostInserted(array $data): void
    {
            $message = $this->createMessage();
            $message->setHtmlBody(
                $this->createLatteTemplate()
                    ->renderToString($this->lattePath . '/addPostMail.latte', $data
            // [ 'title' =>  $data['title'], ... ]
            // alebo len pridat $data za late addPostMail.latte,
            // ak chceme id, tak pouzijeme $retVal->toArray()
            ));
            // aby bolo mozne testovat celu funkciu, Debuger::productionMode mode sa kontroluje az na konci
            $this->send($message);
    }
}