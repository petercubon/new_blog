<?php

declare(strict_types=1);

namespace App\AdminModule\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router
            ->withModule('Admin')
            ->withPath('admin')
            ->addRoute('[<lang=sk sk|en>/]login', 'sign:in')
            ->addRoute('[<lang=sk sk|en>/]clanok/detail/<postId>', 'Post:show')
            ->addRoute('[<lang=sk sk|en>/]<presenter>/<action>', 'Homepage:default');
		return $router;
	}
}
