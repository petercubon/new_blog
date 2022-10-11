<?php

declare(strict_types=1);

namespace App\Components\Post\Other\Filter;

use App\Model\PostManager;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use stdClass;

trait PresenterTrait
{
    private ControlFactory $filterPostControlFactory;
    private PostManager $postManager;

    public function injectFilterPostForm(
        ControlFactory $controlFactory,
        PostManager $postManager,)
    {
        $this->filterPostControlFactory = $controlFactory;
        $this->postManager = $postManager;
    }

    public function createComponentFilterPostForm(): Control
    {
        return $this->filterPostControlFactory->create(
            [$this, 'onSuccess'],
        );
    }

    public function onSuccess(Form $form, stdClass $data): void
    {
        bdump($data->category);

        $this->template->getOtherPosts = $this->postManager->getPostByStatus($data->category);

        $posts = $this->postManager->getPostByStatus($data->category);

        foreach ($posts as $post){
            bdump($post->title);
        }

        $this->redirect('Post:OtherByStatus', $data->category);
    }

}