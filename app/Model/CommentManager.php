<?php

namespace App\Model;

use App\Model\Entity\CommentResource;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\Utils\Callback;

class CommentManager extends BaseManager
{

    public function getTableName(): string
    {
        return 'comment';
    }

    public function getCommentById(int $id)
    {
        return $this->getAll()
                    ->where('post_id', $id);

        return $retVal;
    }

    public function getCommentByPostId(int $id)
    {
        return $this->getAll()
            ->where('post_id', $id);

        return $retVal;
    }

    public function getPostId(int $id)
    {
        $postId = $id;

        return $postId;
    }

    public function deleteComment($id)
    {
        $this->getAll()
            ->where('id', $id)
            ->delete();
    }

    public function insertComment($data)
    {
       $this->getAll()->insert([
           'post_id'   =>      $data['postId'],
           'name'      =>      $data['name'],
           'email'     =>      $data['email'],
           'content'   =>      $data['content'],
           'author_id' =>      $data['author_id'],
       ]);
    }

    public function delete(int $id): void
    {
        $this->getById($id)->delete();
    }

    public function wrapToEntity(ActiveRow $row): CommentResource
    {
        return CommentResource::create($this->getTableName(), $row);
    }

    public function getUserComment(int $id): ?ActiveRow
    {
        return $this->getAll()
            ->get($id);
    }

    public function getCommentByUserId(int $authorId)
    {
        return $this->getAll()
            ->where('author_id', $authorId);
    }

}