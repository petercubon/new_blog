<?php

declare(strict_types = 1);

namespace App\Dashboard\Article\Edit;

use App\Model\DashboardManager;
use Nette\Application\UI\Form;
use Nette\Security\User;

class FormFactory
{
    public function __construct(
        private User $user,
        private DashboardManager $dashboardManager,
    ){ }

// create Form for new Article or Edit of existing Article
    public function create(): Form
    {
        $form = new Form;
        $form->addText('title', 'Nazov clanku')
            ->setRequired();
        $form->addTextArea('content', 'Text clanku')
            ->setRequired();
        $status = [
            '0' => 'navrh na clanok',
            '1' => 'rozpracovany clanok',
            '2' => 'clanok na uverejnenie',
        ];

        $form->addInteger('id', 'id:');

        $form->addSelect('status', 'Status:', $status)
            ->setDefaultValue('1');

        $form->addSubmit('send', 'Ulozit novy clanok');
        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

//  Success method after create form form ArticleonSuccess
    public function onSuccess(Form $form, array $data): void
    {
        // pridat overenie ci exituje clanok, ak ano, tak vykonaj update(), inak insert()
        bdump($data['id']);

        $postId = $data['id'];

        if ($data['id']){

//            $post = $this->dashboardManager->getById($postId);
//            $post->update($data);

            $this->dashboardManager->update($postId, $data);

        }
        else {
            // ak clanok neexistuje, tak ho vytvor cez insert()
            $post = $this->dashboardManager->insert($data);
        }
    }

}