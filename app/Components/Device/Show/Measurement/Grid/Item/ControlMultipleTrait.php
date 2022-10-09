<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid\Item;

use App\Components\Device\Show\Measurement\Grid\Control;
use App\Model\ConsumptionManager;
use App\Model\Entity\ConsumptionResource;
use http\Encoding\Stream\Inflate;
use Nette\Application\UI\Multiplier;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Closure;

trait ControlMultipleTrait
{
    private Selection $consumptions; // Selection je pristupna cez array access
    private ControlFactory $deviceShowMeasurementGridItemControlFactory;
    private ConsumptionManager $consumptionManager;

    public function injectDeviceShowMeasurementGridItem(\App\Components\Device\Show\Measurement\Grid\Item\ControlFactory $controlFactory)
    {
        $this->deviceShowMeasurementGridItemControlFactory = $controlFactory;
    }

    public function createComponentConsumtionsGridItemMultiple()
    {
        $manager = $this->consumptionManager; // vrati Selection s jednotlivymi meraniami pre spotrebic
        $factory = $this->deviceShowMeasurementGridItemControlFactory; // vrati tovarnicku na vytvorenie jednej polozky item
        $onDeleteCallback = Closure::fromCallable([$this, 'onMeasurementDelete']);

        // argument anonymnej funkcie moze byt to co don posielame, alebo to co chceme vypisovat
        // anonymnu funkciu generuje trieda Closure

        return new Multiplier(function (string $id) use ($manager, $factory, $onDeleteCallback){

            bdump($manager->getMeasurementById((int) $id));

            return $factory->create(
              $manager->wrapToEntity($manager->getMeasurementById((int) $id)),
              $onDeleteCallback,
            );

        });

    }

    public function onMeasurementDelete(): void
    {
        $this->redrawControl('consumption');
    }
}