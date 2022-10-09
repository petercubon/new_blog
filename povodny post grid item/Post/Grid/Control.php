<?php

declare(strict_types=1);

namespace App\components\Post\Grid;

use App\Model\PostManager;
use Nette\Application\UI\Control as ControlAlias;
use App\components;
use App\components\Post\Grid\Item\ControlFactory;

class Control extends ControlAlias
{
    use components\Post\Grid\Item\ControlMultipleTrait;

    public function __construct(
        private PostManager $postManager,
        private ControlFactory $controlFactory,
    ) {
        $this->posts = $this->postManager->getPublicPosts();
        $this->injectPostGridItemControlFactory($this->controlFactory);
    }

    public function render(): void
    {
        $this->template->posts = $this->posts;

        $this->template->render(__DIR__ . '/default.latte');
    }
}