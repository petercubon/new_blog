<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Device;

use App\Core\FormFactory as FF;
use App\Model\DeviceManager;
use Nette\Application\UI\Form;

class FormFactory
{
    public function __construct(
        private DeviceManager    $deviceManager,
        private FF $formFactory,
    ) { }

    private int $authorId;

    public function create(int $authorId): Form
    {
        $this->authorId = $authorId;

        $form = $this->formFactory->create();

        $form->addText('name', 'zariadenie')
            ->setRequired('Názov zariadenia je povinný parameter.');

        $form->addText('room', 'miestnost')
            ->setRequired('Umiestnenie zariadenia je povinný parameter.');

        $devices = [
            '0' =>  'Práčka',
            '1' =>  'Sušička na prádlo',
            '2' =>  'Televízor',
            '3' =>  'Chladnička s mrazničkou',
            '4' =>  'Umývačka riadu',
            '5' =>  '',
        ];

        $form->addSelect('select_devices_image', 'zariadenie:', $devices)
            ->setDefaultValue('5');

        $form->addButton('send', 'Pridat zariadenie');

        $form->onSuccess[] = [$this, 'onSuccess']; // pri vytvoreni sa registruje 1. callback

        return $form;
    }

    public function onSuccess(Form $form, \stdClass $data): void
    {
        $image = match ($data->select_devices_image) {
            0 => 'pracka',
            1 => 'susicka_na_pradlo',
            2 => 'televizor',
            3 => 'chladnicka_s_mraznickou',
            4 => 'umyvacka_riadu',
            5 => 'default_image',
        };

        $values = [
            'name'      =>      $data->name,
            'room'      =>      $data->room,
            'image'     =>      $image,
            'author_id' =>      $this->authorId,
        ];

        $this->deviceManager->insert($values);
    }
}