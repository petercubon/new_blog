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
use Nette\Utils\DateTime;

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
            ->fetch();
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
            ->select('verification')
            ->select('register_date')
            ->where('id', $userId)
            ->fetchAll();

        $data = [
            'verification'      =>  $retVal[0]['verification'],
            'register_date'     =>  $retVal[0]['register_date'],
        ];

        return $data;
    }

    public function setUserVerificationStatus(int $userId)
    {
        $retVal = $this->getAll()
            ->where('id', $userId)
            ->update(['status' => 1]);
    }

    public function checkIfUserExist(int $userId)
    {
        $retVal = $this->getAll()
            ->get($userId);

        return $retVal;
    }

    public function updateTokenInUserTable(array $data)
    {
        $retVal = $this->getAll()
            ->where('id', $data['id']);

        $nevVerificationToken = $data['verification'];

        $date = date('Y-m-d H:i:s');

        $retVal->update(['verification' => $nevVerificationToken]);
        $retVal->update(['register_date' => $date]);

        return $retVal;
    }
}