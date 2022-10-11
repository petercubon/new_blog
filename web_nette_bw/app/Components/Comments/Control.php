<?php

declare(strict_types=1);

namespace App\Components\Comments;

use App\Presenters\PostPresenter;
use Nette\Application\UI\Form;

class Control extends \Nette\Application\UI\Control
{
    /**
     * @var callable
     */
    private $onSuccess;

    public function __construct(
        private FormFactory $formFactory,
        callable $onSuccess,
        private $postId,
    ) {
        $this->onSuccess = $onSuccess;
    }

    public function render(): void
    {
        $this->template->render(__DIR__.'/default.latte');
    }

    // Component for new Commentar
    public function createComponentForm(): Form
    {
        $form = $this->formFactory->create($this->postId);

        $form->onSuccess[] = $this->onSuccess;

        return $form;
    }

}