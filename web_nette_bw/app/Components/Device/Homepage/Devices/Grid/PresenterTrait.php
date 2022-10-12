<?php

declare(strict_types=1);

namespace App\Components\Device\Homepage\Devices\Grid;

use Nette\Application\UI\Control;

trait PresenterTrait
{
    private ControlFactory $deviceHomepageDevicesControlFactory;
    private ?int $authorId;

    public function injectHomepageDevices(ControlFactory $controlFactory)
    {
        $this->deviceHomepageDevicesControlFactory = $controlFactory;
        if ($this->user->isLoggedIn()){
            $this->authorId = $this->user->getId();
        }
    }

    public function createComponentDevices(): Control
    {
        return $this->deviceHomepageDevicesControlFactory->create(
            $this->authorId,
        );
    }
}