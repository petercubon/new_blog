<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Grid\Item;

use Nette\Application\UI\Multiplier;
use Nette\Database\Table\ActiveRow;

trait PresenterTrait
{
    private ControlFactory $postOtherGridItemControlFactory;
    private ActiveRow $postGridItem;

    public function inject(ControlFactory $controlFactory)
    {
        $this->postOtherGridItemControlFactory = $controlFactory;
    }

    public function createComponentOtherPostGrid (): Control
    {
        return $this->postOtherGridItemControlFactory->create(
            $this->postGridItem,
        );
    }

    public function createComponentItem()
    {
        $posts = $this->posts;
        $factory = $this->controlFactory;

        return new Multiplier(function (string $id) use ($posts, $factory){
            return$factory->create($posts[(int)$id]);
        });
    }
    
}