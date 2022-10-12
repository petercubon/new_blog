<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\PostResource;
use Nette\Application\LinkGenerator;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use DateTime;

class PostManager extends BaseManager
{
    private LinkGenerator $linkGenerator;

    public  function  getTableName(): string
    {
        return 'post';
    }

    public function getPublicPosts(?int $authorId = null): Selection // return Post where status of post is set to 2, post is a public
        {
            bdump($authorId);

            $retVal = $this->getAll()
                            ->where('created_at <', new DateTime)
                            ->where('status', 2)
                            ->order('id DESC');

            return $retVal;
        }

    public function getAllPosts()
    {
        $retVal = $this->getAll()
                        ->where('created_at <', new DateTime);
        return count($retVal);
    }

    public function getConceptOfPosts()
    {
        $retVal = $this->getAll()
                        ->where('status =', 1);
        return count($retVal);
    }

    public function getCountOfPublicPosts()
    {
        $retVal = $this->getAll()
                        ->where('status', 2);
        return count($retVal);
    }

    public function getOtherPosts(int $id = null, int $authorId = null): Selection
    {
        if($authorId){
            $retVal = $this->getAll()
                ->where('author_id !=', $authorId)
                ->order('created_at DESC');
        }

        if($id){
            $retVal = $this->getAll()
                ->order('created_at DESC')
                ->where('id !=', $id)
                ->limit(9);
        }

        return $retVal;
    }

    public function getWaitingPosts()
    {
        $retVal = $this->getAll()
                        ->where('status', 0);
        return count($retVal);
    }

    public function getIdeaPosts()
    {
        $retVal = $this->getAll()
                        ->where('status', 0);
        return count($retVal);
    }

    public function insert(array $data): ActiveRow
    {
        $retVal = $this->getAll()
            ->insert($data);

        $this->mailSender->sendPostInserted($retVal->toArray());

        return $retVal;
    }

    public function delete(int $id): void
    {
//        $this->getById($id)->delete();

        $this->getAll()
            ->where('id', $id)
            ->delete();
    }

    public function wrapToEntity(ActiveRow $row): PostResource
    {
        return PostResource::create($this->getTableName(), $row);
    }

    public function getOnePost(int $postId)
    {
        $retVal = $this->getAll()
            ->where('id', $postId);

        return $retVal;
    }

    public function getPostByStatus(int $status): Selection
    {
        $retVal = $this->getAll()
            ->where('status', $status);

        return $retVal;
    }
}