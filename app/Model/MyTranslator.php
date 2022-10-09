<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Localization\Translator as Translator;

class MyTranslator implements Translator
{
    public function __construct(
        private string $defaultLang,
    )
    {
    }

    public function setLang(string $lang): void
    {
        $this->defaultLang = $lang;
    }

    public array $translationMapper = [
        'hello_world' => [
            'sk' => 'Ahoj svet',
            'en' => 'Hello World',
        ],
    ];

    /**
     * @inheritDoc
     */
    function translate($message, ...$parameters): string
    {
        // ak exituje message, tak ziskam POLE z $translationMapper, ak neexistuje , tak vrati RETAZEC
        $mess = $this->translationMapper[$message] ?? $message;

        if (is_string($mess)){
            return $mess;
        }

        return $mess[$parameters['lang'] ?? $this->defaultLang];

    }
}