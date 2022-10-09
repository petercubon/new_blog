<?php

declare(strict_types=1);

namespace App\Components\Post\Detail;

use App\Model\Entity\PostResource;
use Closure;
use Nette\Http\IResponse;

trait PresenterTrait
{
    private ControlFactory $postDetailControlFactory;
    private PostResource $post;
    private bool $canCreatePostDetailControl = false;

    public function injectPostDetailControlFactory(ControlFactory $controlFactory): void
    {
        $this->postDetailControlFactory = $controlFactory;
    }

    public function createComponentPostDetailControl(): Control
    {
        if (
            !$this->canCreatePostDetailControl ||
            !$this->post ||
            !$this->postDetailControlFactory
        ){
            $this->error('Stranka nebola najdena.', 404);
        }

        return $this->postDetailControlFactory->create(
            $this->post,
            Closure::fromCallable([$this, 'onPostDelete']),
        );
    }

    public function onPostDelete(bool $isOk): void
    {
        if($isOk){
            $this->flashMessage('Clanok bol uspesne odstraneny.', 'success');
            $this->redirect('Homepage:default');
        }

        $this->error('Na zmazanie clanku nemate opravnenie.', IResponse::S403_FORBIDDEN);

    }
}
