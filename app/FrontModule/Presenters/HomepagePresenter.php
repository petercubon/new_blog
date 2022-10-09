<?php

declare(strict_types=1);

namespace App\FrontModule\Presenters;

use App\Components;
use App\components\Post\Grid\ControlFactory;
use App\Core\FormFactory;
use App\Model\API\SklonovanieMien;
use App\Model\RoleManager;
use App\Model\SettingManager;
use Nette\Application\UI\Form;
use Nette\Caching\Cache;
use Nette\Caching\Storage;
use Nette\Database\Explorer;

final class HomepagePresenter extends BasePresenter
{
    use Components\Post\Grid\ControlTrait;
}
