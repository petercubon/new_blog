<?php

namespace App\Model;

use App\Model\Entity\ConsumptionResource;
use Nette\Database\Table\ActiveRow;

class ConsumptionManager extends BaseManager
{

    public function getTableName(): string
    {
       return 'consumption';
    }

    public function insertMeassure($data)
    {
        $retVal = $this->getAll()
            ->insert($data);
    }

    public function updateMeassure($data)
    {
        $retVal = $this->getAll()
            ->update($data);
    }

    public function getConsumtionById(int $deviceId)
    {
        $retVal = $this->getAll()
            ->where('device_id', $deviceId);

        return$retVal;
    }

    public function getMeasurementById(int $measurementId): ActiveRow
    {
        $retVal = $this->getAll()
            ->get($measurementId);

        return $retVal;
    }

    public function deleteConsumtion(int $consumtionId): void
    {
        $retVal = $this->getAll()
            ->where('id', $consumtionId)
            ->delete();
    }

    public function wrapToEntity(ActiveRow $row): ConsumptionResource
    {
        return ConsumptionResource::create($this->getTableName(), $row);
    }

}