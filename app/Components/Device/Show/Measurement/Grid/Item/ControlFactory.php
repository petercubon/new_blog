<?php

declare(strict_types=1);

namespace App\Components\Device\Show\Measurement\Grid\Item;

use App\Model\Entity\ConsumptionResource;
use Nette\Database\Table\ActiveRow;
use Closure;

interface ControlFactory
{
    public function create(
//        ActiveRow $item,
        ConsumptionResource $item,
        Closure             $onDelete,
    ): Control;
}