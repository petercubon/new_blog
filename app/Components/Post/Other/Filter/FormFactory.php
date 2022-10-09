<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Filter;

use Nette\Application\UI\Form;
use stdClass;

class FormFactory
{
    public function create(): Form
    {
        $form = new Form();

        $category = [
            0   =>  'Návrh na článok',
            1   =>  'Rozpracovaný článok',
            2   =>  'Uverejnený článok',
        ];

        $form->addSelect('category', 'Kategória:', $category);

        $form->addButton('send', 'send');

        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

    public function onSuccess(Form $form, stdClass $data):void
    {

    }
}