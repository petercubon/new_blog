<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid;

use App\Model\ConsumptionManager;
use Nette\Application\UI\Control as NetteControl;
use \App\Components;

class Control extends NetteControl
{
    use Components\Device\Show\Measurement\Grid\Item\ControlMultipleTrait;

    public function __construct(
        private ConsumptionManager $consumptionManager,
        private int $deviceId,
        Components\Device\Show\Measurement\Grid\Item\ControlFactory $controlFactory,
    ) {
        $this->consumptions = $this->consumptionManager->getConsumtionById($this->deviceId);
        $this->injectDeviceShowMeasurementGridItem($controlFactory);
    }

    public function render(): void
    {
        $this->template->consumptions = $this->consumptions;
        $this->template->render(__DIR__.'/default.latte');
    }
}