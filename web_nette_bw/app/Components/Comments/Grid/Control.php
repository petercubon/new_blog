<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid;

use App\Model\CommentManager;
use Closure;
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
    public $page = 2;
    private $itemsPerPage = 3;

    public function __construct(
        private CommentManager $manager,
        private ?int $postId = null,
        private ControlFactory $controlFactory,
    ) { }

    public function render(): void
    {
        $this->template->numOfPages = 0;
        $this->template->page = $this->page;
        // $this->template->comments = $this->manager->getCommentByPostId($this->postId)->page($this->page, $this->itemsPerPage);
        $this->template->comments = $this->manager->getCommentByPostId($this->postId);

        $this->template->render(__DIR__ . '/default.latte');
    }

    public function createComponentPostCommentGridItemMultiple(): Component
    {
        $manager = $this->manager;
        $factory = $this->controlFactory;
        $onDeleteCallback = Closure::fromCallable([$this, 'onCommentDelete']);

        return new Multiplier(function (string $id) use ($manager, $factory, $onDeleteCallback) {

            return $factory->create(
                $manager->wrapToEntity($manager->getById((int) $id)), // getById returns an ActiveRow and it is wrapped in an entity
                $onDeleteCallback,
            );
        });
    }

    public function onCommentDelete(bool $isOK): void
    {
        if ($isOK){
            $this->flashMessage('Zmazanie komentaru bolo uspesne.', 'success');
            $this->redrawControl('comments');

        } else {
            $this->flashMessage('Zmazanie komantaru nebolo uspesne   .', 'error');
        }

        $this->redrawControl('flashes');
    }

    public function handleLoadMore(): void
    {
        $this->page += 1;
        $this->redrawControl('comments');
    }

}