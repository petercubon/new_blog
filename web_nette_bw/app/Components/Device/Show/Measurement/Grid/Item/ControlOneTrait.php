<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid\Item;

use App\Components\Device\Show\Measurement\Grid\Control;
use Nette\Database\Table\ActiveRow;

trait ControlOneTrait
{
    private ControlFactory $deviceShowMeasurementGridItemControlFactory;
    private ActiveRow $deviceShowMeasurementGridItem;

    public function injectDeviceShowMeasurementGridItem(\App\Components\Device\Show\Measurement\Grid\Item\ControlFactory $controlFactory)
    {
        $this->deviceShowMeasurementGridItemControlFactory = $controlFactory;
    }

    public function createComponentMeasurementGridItem(): \Nette\Application\UI\Control
    {
        return $this->deviceShowMeasurementGridItemControlFactory->create($this->deviceShowMeasurementGridItem);
    }
}