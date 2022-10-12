<?php

declare(strict_types=1);

namespace App\Components\Comments\Grid\Item;

use Nette\Application\UI\Multiplier;
use Nette\Database\Table\Selection;

trait ControlMultipleTrait
{
    private ControlFactory $commentsGridItemControlFactory;
    private Selection $comments;


    public function injectCommentsGridItemControlFactory(ControlFactory $controlFactory)
    {
        $this->commentsGridItemControlFactory = $controlFactory;
    }

    public function createComponentCommentGridItemMultiple()
    {
        $comments = $this->comments;
        $factory = $this->commentsGridItemControlFactory;

        return new Multiplier(function (string $id) use ($comments, $factory) {
            return $factory->create($comments[(int) $id]);
        });
    }

}