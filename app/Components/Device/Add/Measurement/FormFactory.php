<?php

declare(strict_types=1);

namespace App\Components\Device\Add\Measurement;

use App\Model\ConsumptionManager;
use Nette\Application\UI\Form;
use Nette\Security\User;

class FormFactory
{
    private ?int $id;
    private ?int $deviceId;

    public function __construct(
        private ConsumptionManager $consumptionManager,
        private User $user,
    ) { }

    public function create(int $id = null, int $deviceId = null): Form
    {
        $this->id = $id;
        $this->deviceId = $deviceId;

        $form = new Form();
        $form->addText('startValue', 'startValue');
        $form->addText('startTime', 'startTime');
        $form->addText('endValue', 'endValue');
        $form->addText('endTime', 'endTime');
        $form->addButton('send', 'Pridat meranie');

        $form->onSuccess[] = [$this, 'onSuccess'];

        if ($id){
            $data = $this->consumptionManager->getMeasurementById($id);
            $data = [
                    'startValue'    =>  $data->startvalue/1e3,
                    'startTime'    =>  $data->starttime,
                    'endValue'    =>  $data->endvalue/1e3,
                    'endTime'    =>  $data->endtime,
                    ];
            $form->setDefaults($data);
        }

        return $form;
    }

    public function onSuccess(Form $form, \stdClass $data): void
    {
        $startValue = (float) $data->startValue * 1000;
        $startTime = $data->startTime;
        $endValue = (float) $data->endValue * 1000;
        $endTime = $data->endTime;

        $consumption = $endValue - $startValue;

        $distance = ((strtotime($endTime) - strtotime($startTime)) / 60);

        if (!$endValue > $startValue) {
            $this->redirect('this');
            $this->flashMessage('Hodnota na konci merania musí byť väčšia ako hodnota na začiatku merania.', 'error');
        }

        if (!$endTime > $startTime) {
            $this->redirect('this');
            $this->flashMessage('Dátum a čas na konci merania musí byť neskôr, ako je dátum a čas na začiatku merania.', 'error');
        }

        $hourlyConsumption = $consumption / ($distance / 60);

        $dailyConsumption = $hourlyConsumption * 24;

        $yearlyConsumption = $dailyConsumption * 365;

        $values = [
            'startvalue'            =>      (int) $startValue,
            'starttime'             =>      $startTime,
            'endvalue'              =>      (int) $endValue,
            'endtime'               =>      $endTime,
            'hourlyconsumption'     =>      (int) $hourlyConsumption,
            'dailyconsumption'      =>      (int) $dailyConsumption,
            'yearlyconsumption'     =>      (int) $yearlyConsumption,
            'device_id'             =>      $this->deviceId,
            'author_id'             =>      $this->user->getId(),
        ];

        if($this->id){
            unset($values['device_id']);
            $this->consumptionManager->updateMeassure($values);
        } else {
            $this->consumptionManager->insertMeassure($values);
        }

    }
}