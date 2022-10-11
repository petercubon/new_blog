<?php

declare(strict_types=1);

namespace App\FrontModule\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router
            ->withModule('Front')
            ->addRoute('[<lang=sk sk|en>/]editaciaPrispevku/<postId>', 'DashboardPresenter:edit')
            ->addRoute('[<lang=sk sk|en>/]vytvoreniePrispevku/<postId>', 'DashboardPresenter:add')
            ->addRoute('[<lang=sk sk|en>/]<presenter>/<action>[/<id>]', 'Homepage:default');

		return $router;
	}
}
