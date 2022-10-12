<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Security\Role;

class RoleManager extends BaseManager
{
    public function getTableName(): string
    {
        return 'role';
    }

    public function findByUserId(int $id): Selection // roli moze byt viac, preto prefix "find"
    {
        return $this->getAll()
            ->where(':user_x_role.user_id', $id);
    }

    public function findByUserIdToSelect(int $id): array // roli moze byt viac, preto prefix "find"
    {
        return $this->findByUserId($id)
            ->fetchPairs('id', 'name');
    }

    public function findAllByUserIdToSelectReturnedAsEntity(int $id): array
    {
        return array_map(
            function (string $name) use ($id) {
                return \App\Model\Entity\Role::create($id, $name);
            },
        $this->findByUserIdToSelect($id),
        );
    }

    public function findAllByUserIdAsEntity(int $id): array
    {
        return array_map(
            function (string $name) use ($id) {
                return \App\Model\Entity\Role::create($id, $name);
            },
            $this->findByUserIdToSelect($id),
        );
    }
}