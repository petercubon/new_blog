<?php

declare(strict_types=1);

namespace App\Components\Post\Grid;

use App\Model\PostManager;
use Nette\Application\UI\Control as ControlAlias;
use \App\Components;
use \App\Components\Post\Grid\Item\ControlFactory;
use Nette\Security\User;

class Control extends ControlAlias
{
    use Components\Post\Grid\Item\ControlMultipleTrait;

    // public, pretoze sa plni automaticky z url adresy
    // ide o tzv. perzistentny parameter
    /**
     * @var int @persistent
     */
    public int $page = 1;
    private int $itemsPerPage = 6;
    private int $numOfPages;

    public function __construct(
        private PostManager $postManager,
        ControlFactory $controlFactory,
        private ?int $authorId,
        private User $user,
    ) {
      $this->inject($controlFactory);
    }

    public function render(): void
    {

        $this->authorId = $this->user->getId();

        $this->template->numOfPages = 0;
        $this->template->page = $this->page;
        $this->template->posts = $this->postManager->getPublicPosts(authorId: $this->authorId)->page($this->page, $this->itemsPerPage, $this->template->numOfPages);

        $this->template->render(__DIR__ . '/default.latte');
    }

    // vytvorenie Signalu pre strankovanie
    // Signal funguje len v komponente, alebo v Presenteri
    public function handlePage(int $page): void
    {
        $this->page = $page;
    }

}