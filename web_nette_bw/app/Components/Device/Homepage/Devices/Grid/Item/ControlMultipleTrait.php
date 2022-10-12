<?php

declare(strict_types=1);

namespace App\Components\Device\Homepage\Devices\Grid\Item;

use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;
use Closure;

trait ControlMultipleTrait
{
    private Selection $devices;
    private ControlFactory $deviceHomepageDevicesControlFactory;

    public function injectHomepageDevices(ControlFactory $controlFactory)
    {
        $this->deviceHomepageDevicesControlFactory = $controlFactory;
    }

    public function createComponentDevicesGridItemMultiple()
    {
        $manager = $this->deviceManager;
        $factory = $this->deviceHomepageDevicesControlFactory;
        $onDeleteCallback = Closure::fromCallable([$this, 'onDeviceDelete']);

        return new Multiplier(function (string $id) use ($manager, $factory, $onDeleteCallback){

            return $factory->create(
                $manager->wrapToEntity($manager->getDeviceById((int) $id)),
                $onDeleteCallback,
            );

        });
    }

    public function onDeviceDelete(bool $isOk): void
    {
        if ($isOk){
            $this->redrawControl('devices');
            $this->flashMessage('Odstránenie spotrebiča bolo úspešné.', 'success');
        } else {
            $this->flashMessage('Odstránenie spotrebiča bolo neúspešné.', 'error');
        }
        $this->redrawControl('flashes');

    }

}