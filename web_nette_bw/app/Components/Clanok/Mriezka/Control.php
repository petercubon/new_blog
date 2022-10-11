<?php

declare(strict_types=1);

namespace App\Components\Clanok\Mriezka;

use App\Model\PostManager;
use App\Components;
use App\Components\Clanok\Mriezka\Polozka\ControlFactory;

class Control extends \Nette\Application\UI\Control
{
    use Components\Clanok\Mriezka\Polozka\ControlMultipleTrait;

    public function __construct(
        private PostManager $postManager,
        ControlFactory $controlFactory,
    )
    {
        $this->clanky = $this->postManager->getPublicPosts();
        $this->injectClanokMriezkaPolozkaControlFactory($controlFactory);
    }

    public function render(): void
    {
        $this->template->clanky = $this->clanky;

        $this->template->render(__DIR__.'/default.latte');
    }

}