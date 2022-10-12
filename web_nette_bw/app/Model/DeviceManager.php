<?php

namespace App\Model;

use App\Model\Entity\DeviceResource;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

class DeviceManager extends BaseManager
{

    public function getTableName(): string
    {
        return 'device';
    }

    public function showDevices(int $author_id)
    {
        $retVal = $this->getAll()
            ->where('author_id', $author_id)
            ->order('name');

        return $retVal;
    }

    public function insert($data)
    {
        $this->getAll()
            ->insert($data);
    }

    public function getDeviceById(int $deviceId)
    {
        $retVal = $this->getAll()
            ->get($deviceId);

        return $retVal;
    }

    public function getDeviceName(int $id)
    {
        $retVal = $this->getAll()
            ->get($id);

        return $retVal;
    }

    public function wrapToEntity(ActiveRow $row): DeviceResource
    {
        return DeviceResource::create($this->getTableName(), $row);
    }

    public function delete(int $deviceId)
    {
        $retVal = $this->getAll()
            ->where('id', $deviceId)
            ->delete();

        return $retVal;
    }

}