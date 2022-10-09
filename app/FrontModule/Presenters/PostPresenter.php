<?php

declare(strict_types=1);

namespace App\FrontModule\Presenters;

use App\Presenters\PostPresenter as APPostPresenter;

class PostPresenter extends APPostPresenter
{
    use SecurePresenterTrait;
}