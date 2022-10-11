<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Device;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

trait PresenterTrait
{
    private ControlFactory $deviceAddControlFactory;
    private ?int $authorId;

    // Inject ControlFactory
    public function injectDeviceAddControlFactory(ControlFactory $controlFactory)
    {
        $this->deviceAddControlFactory = $controlFactory;

        if($this->user->isLoggedIn()){
             $this->authorId = $this->user->getId();
        }
    }

    // Create Component through ControlFactory
    public function createComponentAddDevice(): Control
    {
        return $this->deviceAddControlFactory->create(
            [$this, 'onDeviceAddFormSuccess'],
            $this->authorId,
        );
    }

    // Add Device Form Success
    public function onDeviceAddFormSuccess(Form $form, \stdClass $data)
    {
        $this->redrawControl('devices');
    }
}