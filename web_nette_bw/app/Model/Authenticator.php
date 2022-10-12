<?php

declare(strict_types=1);

namespace App\Model;

use Exception; // pouzitie klasickej PHP exception
use Nette\Database\Table\ActiveRow;
use Nette\Security\AuthenticationException;
use Nette\Security\IdentityHandler;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;
use Nette\Security\Authenticator as NetteAuthenticator; // pridany allias

class Authenticator implements NetteAuthenticator, IdentityHandler
{
    private UserManager $userManager;
    private Passwords $passwords;
    private RoleManager $roleManager;

    public function __construct(
        UserManager $userManager,
        Passwords $passwords,
        RoleManager $roleManager,
    )
    {
        $this->userManager = $userManager;
        $this->passwords = $passwords;
        $this->roleManager = $roleManager;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    function authenticate(string $user, string $password): IIdentity
    {
        $row = $this->userManager
                    ->getByEmail($user);

        bdump($this->userManager->getByEmail($user));

        if (!$row) {
            throw new Exception('Pouzivatel so zadanym menom neexistuje.');
        }

        if (!$this->passwords->verify($password, $row->password)) { // overenie pre hashovane heslo
            throw new Exception('Nespravne heslo.');
        }

        $user = $row->toArray();    // variable with user data
        unset($user[$password]);    // remove password from user data

        return new SimpleIdentity(
            $row->id,
            $this->roleManager->findAllByUserIdAsEntity($row->id),
            $user,               // user data
        );
    }

    public function register(array $data): ActiveRow
    {
        $newUser = $this->userManager->register($data);
        return $newUser;
    }

    // current user identity each time the web browser is refreshed
    function sleepIdentity(IIdentity $identity): IIdentity
    {
        return $identity;
    }

    // the current user identity each time the web browser is refreshed according to the database
    function wakeupIdentity(IIdentity $identity): ?IIdentity
    {
        $userId = $identity->getId();
        $identity->setRoles($this->roleManager->findAllByUserIdToSelectReturnedAsEntity($userId));
        return $identity;
    }

    //create token and update it on user table
    public function updateTokenInUserTable(array $data)
    {
        $updateTokenInUserTable = $this->userManager->updateTokenInUserTable($data);

        return $updateTokenInUserTable;
    }
}
