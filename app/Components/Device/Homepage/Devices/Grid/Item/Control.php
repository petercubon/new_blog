<?php

declare(strict_types=1);

namespace App\Components\Device\Homepage\Devices\Grid\Item;

use App\Model\DeviceManager;
use App\Model\Entity\DeviceResource;
use Nette\Database\Table\ActiveRow;
use Closure;
use Nette\Security\User;

class Control extends \Nette\Application\UI\Control
{
    public function __construct(
        private DeviceResource $item,
        private Closure $onDelete,
        private DeviceManager $deviceManager,
        private User $user,
    ) { }

    public function render(): void
    {
        $this->template->device = $this->item;
        $this->template->render(__DIR__ . '/default.latte');
    }

    public function handleDeleteDevice(): void
    {
        $isAllowedToDeleteThis = $this->user->isAllowed($this->item, 'delete');

        if ($isAllowedToDeleteThis){
            $this->deviceManager->delete($this->item->id);
        }

        ($this->onDelete)($isAllowedToDeleteThis);
    }
}