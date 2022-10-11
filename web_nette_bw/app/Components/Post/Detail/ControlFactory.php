<?php

namespace App\Components\Post\Detail;


use App\Model\Entity\PostResource;
use Closure;

interface ControlFactory
{
    public function create(
        PostResource $item,
        Closure $onDelete
    ): Control;
}