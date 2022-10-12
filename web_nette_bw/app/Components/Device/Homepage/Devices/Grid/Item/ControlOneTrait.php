<?php

declare(strict_types=1);

namespace App\Components\Device\Homepage\Devices\Grid\Item;

use Nette\Application\UI\Control;

trait ControlOneTrait
{
    private ControlFactory $deviceHomepageDevicesControlFactory;

    public function injectHomepageDevices(ControlFactory $controlFactory)
    {
        $this->deviceHomepageDevicesControlFactory = $controlFactory;
    }
}