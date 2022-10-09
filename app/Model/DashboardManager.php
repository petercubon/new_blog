<?php

declare(strict_types=1);

namespace App\Model;

use Latte\Engine;
use Nette\Bridges\ApplicationLatte\TemplateFactory;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use DateTime;
use Nette\Database\Table\Selection;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Nette\SmartObject;
use Tracy\Debugger;

class DashboardManager extends BaseManager
{
    protected Explorer $db;

    public function __construct(
        Explorer $db,
        private MailSender $mailSender,
    )
    {
        $this->db = $db;
    }

    public function getTableName(): string
    {
        return 'post';
    }

    public function getCountPublicPosts(): int
    {
        $retVal = $this->getAll()
                        ->where('status', 2);
        return count($retVal);

    }

    public function getCountAllPosts(): int
    {
        $retVal = $this->getAll();
        return count($retVal);
    }

    public function getCountConceptOfPosts(): int
    {
        $retVal = $this->getAll()
                        ->where('status =', 1);
        return count($retVal);
    }

    public function getPublicPosts() // return Post where status of post is set to 3, post is a public
    {
        $retVal = $this->getAll()
                        ->where('created_at <', new DateTime)
                        ->where('status', 2)
                        ->order('created_at DESC');
        return $retVal;
    }

    public function getCountIdeaPosts(): int
    {
        $retVal = $this->getAll()
                        ->where('status', 0);
        return count($retVal);
    }

    public function getAllPosts(): Selection
    {
        $retVal = $this->getAll()
                        ->where('created_at <', new DateTime);
        return $retVal;
    }

    public function getConcepts(): Selection
    {
        $retVal = $this->getAll()
                        ->where('status', 1);
        return $retVal;
    }

    public function getIdeaPosts(): Selection
    {
        $retVal = $this->getAll()
                        ->where('status', 0);
        return $retVal;
    }

    public function update($postId, $data)
    {
        $this->getAll()
            ->where('id', $postId)
            ->update($data);
    }

    public function insert(array $data): ActiveRow
    {
        $retVal = $this->getAll()
            ->insert($data);

        if (Debugger::$productionMode){
            $this->mailSender->sendPostInserted($retVal->toArray());
        }

        return $retVal;
    }


}