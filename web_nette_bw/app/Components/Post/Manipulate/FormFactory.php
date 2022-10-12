<?php

declare(strict_types=1);

namespace App\Components\Post\Manipulate;

use App\Core\FormFactory as CoreFormFactory;
use App\Model\DashboardManager;
use Nette\Application\UI\Form;
use Nette\Security\User;
use Nette\SmartObject;

class FormFactory
{
    use SmartObject; // vsade kde nie je extend, je potrebne pouzit trait SmartObject

    private array $entity;

    public function __construct(
        private DashboardManager $manager,
        private CoreFormFactory  $coreFormFactory,
        private User $user,
    ) {
    }

    // pridanie noveho prispevku na blog
    public function create(array $entity): Form
    {
        $this->entity = $entity;

        $form = $this->coreFormFactory->create();

        $form->addHidden('id');
        $form->addText('title', 'Nazov clanku')
            ->setRequired();
        $form->addTextArea('content', 'Text clanku')
            ->setRequired();
        $status = [
            '0' => 'návrh na článok',
            '1' => 'rozpracovaný článok',
            '2' => 'článok na uverejnenie',
        ];

        $form->addSelect('status', 'Status:', $status)
            ->setDefaultValue('1');

        $form->addSubmit('send', 'Ulozit novy clanok');

        $form->onSuccess[] = [$this, 'onSuccess'];

        $form->setDefaults($entity);

        return $form;
    }

    public function onSuccess(Form $form, array $data): void
    {
        $entityId = $this->entity['id'];

        if ($entityId){
            // ak exituje tak update
            $this->manager->update($entityId, $data);
        }
        else {
            // ak clanok neexistuje, tak ho vytvor cez insert()
            unset($data['id']);
            $data['author_id'] = $this->user->id;
            $entityId = $this->manager->insert($data)->id;
        }

        $form['id']->setValue($entityId);
    }

}