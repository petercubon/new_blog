<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid\Item;

use App\Model\ConsumptionManager;
use App\Model\DeviceManager;
use App\Model\Entity\ConsumptionResource;
use Nette\Application\UI\Control as NetteControl;
use Nette\Database\Table\ActiveRow;
use Closure;
use Nette\Security\User;

class Control extends NetteControl
{
    public function __construct(
        private ConsumptionResource $item,
        private Closure             $onDelete,
        private ConsumptionManager  $consumptionManager,
        private User                $user,
    ) { }

    public function render(): void
    {
        $this->template->consumption = $this->item;
        $this->template->render(__DIR__.'/default.latte');
    }

    public function handleDeleteMeasurement(): void
    {
//        $isAllowedToDeleteThis = $this->user->isAllowed($this->item, 'delete');

//        if($isAllowedToDeleteThis){
            $this->consumptionManager->deleteConsumtion($this->item->id);
//        }
        ($this->onDelete)();
    }
}