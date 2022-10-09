<?php

declare(strict_types=1);

namespace App\AdminModule\Presenters;

use App\Presenters\Presenter;

abstract class BasePresenter extends Presenter
{
    use SecurePresenterTrait;
}