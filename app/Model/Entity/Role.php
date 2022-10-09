<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Security\Role as NSRole;

class Role implements NSRole
{
    public function __construct(
        private int $userId,
        private string $roleId,
    ) { }

    function getRoleId(): string // vrati ID role
    {
         return $this->roleId;
    }

    public function getUserId(): int // vrati ID usera
    {
        return $this->userId;
    }

    // tovarenska metoda
    public static function create(int $userId, string $roleId): self
    {
        return new Role($userId, $roleId);
    }
 }