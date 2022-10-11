<?php

namespace App\FrontModule\Presenters;

use App\Components\Device\Add\Device\Control as MyControl;
use App\Components\Device\Add\Device\ControlFactory;
use App\Components;
use App\Components\Device\Add\Measurement\Control as MyMeasurementControl;
use App\Components\Device\Add\Measurement\ControlFactory as ControlFactoryAddMeasurement;
use App\Components\Device\Add\Measurement\FormFactory as FormFactoryDeviceAddMeasurement;
use App\Model\ConsumptionManager;
use App\Model\DeviceManager;
use App\Model\Entity\DeviceResource;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;

class DevicePresenter extends \Nette\Application\UI\Presenter
{
    use Components\Device\Add\Device\PresenterTrait;

    use Components\Device\Add\Measurement\PresenterTrait;

    use Components\Device\Show\Measurement\Grid\ControlTrait;

    use Components\Device\Homepage\Devices\Grid\PresenterTrait;

    private ?int $deviceId;
    private ?int $authorId;
    private ?int $measurementId;
    private string $deviceName;
    private bool $canCreateNewDevice;

    public function __construct(
        private DeviceManager                $deviceManager,
        private ControlFactory               $deviceAddControlFactory,
        private ControlFactoryAddMeasurement $deviceAddMeasurementControlFactory,
        private ConsumptionManager $consumptionManager,
    ) { }

    // Action
    public function actionShow(int $deviceId)
    {
        $this->checkPrivilege( 'showDevices' ,'view');
        $this->deviceId = $deviceId;
        $this->template->device = $this->deviceManager->getDeviceById($deviceId);
        $this->canCreateNewDevice = $this->getUser()->isAllowed('showDevices', 'view');
    }

    public function renderShow(int $deviceId): void
    {
        $this->template->device = $this->deviceManager->getDeviceById($deviceId);
    }

    // Action AddMeasurement
    public function actionaddMeasurement(int $deviceId, string $deviceName)
    {
        $this->checkPrivilege('addNewDevice', 'add');

        $this->measurementId = 0;
        $this->deviceId = $deviceId;
        $this->deviceName = $deviceName;
    }

    // Action EditMeasurement
    public function actionEditMeasurement(int $measurementId = 0)
    {
        $this->checkPrivilege('showDevices', 'edit');

        $consumption = $this->consumptionManager->getMeasurementById($measurementId);
        if(!$consumption){
            $this->error('Požadovaný záznam neexistuje.', 404);
        }

        $this->measurementId = $measurementId;
        $this->deviceId = 0;
        $id = $this->consumptionManager->getMeasurementById($measurementId)->device_id;
        $this->deviceName = $this->deviceManager->getDeviceName($id)->name;
    }

    public function checkPrivilege(string $resource, string $privilege)
    {
        if (!$this->getUser()->isAllowed($resource, $privilege)){
            $this->flashMessage('Pre túto akciu je potrebné sa prihlásiť.', 'error');
            $this->redirect('Sign:in');
        }
    }

    public function actionDeleteDevice(int $deviceId): void
    {
        $this->deviceId = $deviceId;
        $this->device = $this->deviceManager->getDeviceById($deviceId);
    }

}