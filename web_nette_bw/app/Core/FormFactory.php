<?php

declare(strict_types=1);

namespace App\Core;

use Nette\Application\UI\Form;
use Nette\Localization\Translator;

class FormFactory
{
    public function __construct(
        private Translator $translator
    ) { }

    // metoda na vytvorenie vsetkych formularov - p.24 Spolocny predok vsetkych formularov
    public function create(): Form
    {
        $form = new Form();

        $form->getElementPrototype()
            ->setAttribute('class', 'ajax')
            ->setAttribute('novalidate', 'novalidate');

        $form->setTranslator($this->translator);

        return $form;
    }
}