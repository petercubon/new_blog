<?php

declare(strict_types=1);

namespace App\Model\Entity;

class CommentResource extends Resource
{
    public function getPostAuthorId(): int
    {
        return $this->resource->post->author_id;
    }
}