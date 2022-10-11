<?php

declare(strict_types=1);

namespace App\Components\Post\Manipulate;

use Nette\Application\UI\Form;
use Nette\Application\UI\Control;

trait PresenterTrait
{
    private ControlFactory $postManipulateControlFactory;
    private array $entity = [
        'id' => 0,
    ];

    public function injectPostManipulateControlFactory(ControlFactory $controlFactory)
    {
        $this->postManipulateControlFactory = $controlFactory;
    }

    public function createComponentPostForm(): Control
    {
        // $this->>getUser() je mozne pouzit iba v Presentroch (to plati aj pre flashMessage a redirect
        if (!$this->getUser()->isLoggedIn()){
            $this->error('Pre vytvorenie, alebo úpravu článku je potrebné prihlásenie.');
        }

        return $this->postManipulateControlFactory->create(
            [$this, 'onArticleEditFormSuccess'],
            $this->entity,
        );
    }

    public function onArticleEditFormSuccess(Form $form, array $data): void
    {
        $this->flashMessage('Clanok bol uspesne ulozeny.');
        $this->redirect('post:show', $data['id']);
    }
}