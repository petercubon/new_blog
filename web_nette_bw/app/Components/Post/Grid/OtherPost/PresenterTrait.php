<?php

declare(strict_types=1);

namespace App\Components\Post\Grid\OtherPost;

use Nette\Database\Explorer;

trait PresenterTrait
{
    public function __construct(
        private Explorer $db,
    ) { }

    public function renderDefault()
    {
        $otherPosts = $this->db->table('post')
            ->fetchAll();

        bdump($otherPosts);

        $this->template->otherPosts = $otherPosts;
    }
}