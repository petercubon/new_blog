<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid;

trait ControlTrait // vola sa ako s presenteru tak aj s komponentu, obe su typu Cntrol => ControlOneTrait
{
    private ControlFactory $deviceShowMeasurementGridControlFactory;

    public function injectDeviceShowMeasurementGrid(ControlFactory $controlFactory)
    {
        $this->deviceShowMeasurementGridControlFactory = $controlFactory;
    }

    public function createComponentMeasurementGrid(): Control
    {
        return $this->deviceShowMeasurementGridControlFactory->create($this->deviceId);
    }

}