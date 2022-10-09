<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Entity\PostResource;
use App\Model\Entity\Resource;
use App\Model\MyTranslator;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Presenter as UIPresenter;
use Nette\Localization\Translator;
use Nette\DI\Attributes\Inject;

class Presenter extends UIPresenter // Presenter spolocny pre front aj admin modul
{
    // perzistentny parameter je pristupny vsade okrem komponentov
    /** @persistent */
    public string $lang;
    #[inject] public Translator $translator;

    protected function startup()
    {
        parent::startup();

        if ($this->translator instanceof MyTranslator){
            $this->translator->setLang($this->lang);
        }
    }

    protected function checkPrivilege(string|Resource $resource, string $privilege): void
    {
        if (!$this->getUser()->isAllowed($resource, $privilege)){
            $this->flashMessage('Pre tuto akciu nemate postacujuce opravnenie.', 'error');
            $this->redirect('Sign:in', $this->storeRequest());
        }
    }
}