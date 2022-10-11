<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\SmartObject;

abstract class BaseManager
{
    use SmartObject;

    protected Explorer $db;

    public function __construct(
        Explorer $db
    )
    {
        $this->db = $db;
    }

    abstract public function getTableName(): string;

    public function getAll(): Selection
    {
        return $this->db->table($this->getTableName());
    }

    public function getById(int $id): ?ActiveRow // ": ?ActiveRow" metoda vracia bud null, alebo ActiveRow, pri jej pouziti error
    {
        return $this->getAll()
            ->get($id); // argument "get()" je datovy typ primarneho kluca, nikdy nie NULL
    }
}