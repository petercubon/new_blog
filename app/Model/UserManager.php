<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Application\LinkGenerator;
use Nette\Bridges\ApplicationLatte\TemplateFactory;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Tracy\Debugger;

class UserManager extends BaseManager
{
    public function __construct(
        protected Explorer $db,
    ) { }

    public function getTableName(): string
    {
        return 'user';
    }

    public function getByEmail(string $email): ?ActiveRow // "get" prefix by mal vzdy vratit "ActiweRow", "find" prefix by mal vratit "Selection"
    {
        return $this->getAll()
            ->where('email', $email)
            ->fetch(); // "fetch()" nakolko chceme iba jeden
    }

    public function register(array $data): ActiveRow
    {
        $newUser = $this->getAll()
            ->insert($data);

        $userRole = $this->db->table('user_x_role')
            ->insert([
                'user_id'   =>    $newUser->id,
                'role_id'   =>    2,
                ]);

        return $newUser;
    }

    public function getVerificationToken(int $userId)
    {
        $retVal = $this->getAll()
            ->select('verificationtoken')
            ->select('register_date')
            ->where('id', $userId)
            ->fetchAll();

        $data = [
            'verificationtoken' =>  $retVal[0]['verificationtoken'],
            'register_date' =>  $retVal[0]['register_date'],
        ];

        return $data;
    }

    public function setUserVerificationStatus(int $userId)
    {
        $retVal = $this->getAll()
            ->where('id', $userId)
            ->update(['status' => 1]);
    }
}