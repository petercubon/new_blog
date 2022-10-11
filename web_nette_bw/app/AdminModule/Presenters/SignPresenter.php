<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Presenters\SignPresenter as APSignPresenter;

class SignPresenter extends APSignPresenter
{
    use SecurePresenterTrait;
}