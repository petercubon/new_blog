<?php

declare(strict_types=1);

namespace App\Components\Device\Homepage\Devices\Grid;

use App\Components;
use App\Model\DeviceManager;
use App\Components\Device\Homepage\Devices\Grid\Item\ControlFactory;

class Control extends \Nette\Application\UI\Control
{
    use Components\Device\Homepage\Devices\Grid\Item\ControlMultipleTrait;

    public function __construct(
        private DeviceManager $deviceManager,
        ControlFactory $controlFactory,
        private ?int $authorId,
    ) {
        $this->injectHomepageDevices($controlFactory);
    }

    public function render(): void
    {
        $this->template->devices = $this->deviceManager->showDevices($this->authorId);
        $this->template->render(__DIR__ . '/default.latte');
    }
}