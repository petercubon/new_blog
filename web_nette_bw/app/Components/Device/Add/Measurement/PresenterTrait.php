<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Measurement;

use Nette\Application\UI\Control;

trait PresenterTrait
{
    private ControlFactory $deviceAddMeasurementControlFactory;

    public function injectdeviceAddMeasurementControlFactory(ControlFactory $controlFactory)
    {
        $this->deviceAddMeasurementControlFactory = $controlFactory;
    }

    // Add Measurement Form
    public function createComponentAddMeasurementForm(): Control
    {
        if (!$this->getUser()->isLoggedIn()){
            $this->error('Pre vytvorenie, alebo editovanie spotreby zariadenia je potrebne sa prihlasit.');
        }

        return $this->deviceAddMeasurementControlFactory
            ->create([$this, 'onsuccess'],
                $this->measurementId,
                $this->deviceId,
                $this->deviceName,
            );
    }

    public function onsuccess(): void
    {
        bdump('SEM');
        $this->flashMessage('Vaše meranie bolo úspešne uložené.', 'sucess');
        $this->redirect('Device:show', $this->deviceId);
    }
}