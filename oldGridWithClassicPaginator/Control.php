<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid;

use App\Model\CommentManager;
use Nette\Application\UI\Component;
use Nette\Application\UI\Control as uiControl;
use App\Components;
use App\Components\Comments\Grid\Item\ControlFactory;
use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

class Control extends uiControl
{
    /**
     * @var int @persistent
     */
    public $page = 1;
    private $itemsPerPage = 2;

    public function __construct(
        private CommentManager $manager,
        private ?int $postId = null,
        private ControlFactory $controlFactory,
    ) {
//        $this->injectCommentsGridItemControlFactory($controlFactory);
    }

    public function render(): void
    {
        $this->template->numOfPages = 0;
        $this->template->page = $this->page;
        $this->template->comments = $this->manager->getCommentById($this->postId)->page($this->page, $this->itemsPerPage, $this->template->numOfPages);

        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentPostCommentGridItemMultiple(): Component
    {
        $manager = $this->manager;
        $factory = $this->controlFactory;

        return new Multiplier(function (string $id) use ($manager, $factory) {
            return $factory->create($manager->getById((int) $id));
        });
    }

    public function handlePage(int $page): void
    {
        $this->page = $page;
    }

}