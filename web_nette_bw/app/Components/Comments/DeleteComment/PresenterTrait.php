<?php

declare(strict_types=1);

namespace App\Components\Comments\DeleteComment;

use Nette\Application\UI\Multiplier;

trait PresenterTrait
{
    private FormFactory $formFactory;
    
// INJECT 
    public function injectCommentDeletetControl(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

// COMMENT DELETE FORM
//  Component form for delete comment

    protected function createComponentDeleteForm(): Multiplier
    {
        return new Multiplier(function ($commentId) {

            return new \App\Components\Comments\DeleteComment\Control
//                ($this->commentManager, $this->deleteComment, [$this, 'deleteFormSuccess'], $commentId);
            ($this->formFactory, [$this, 'deleteFormSuccess'], $commentId);
        });
    }

    // onSuccess for Comment Delete
    public function deleteFormSuccess(): void
    {
        $this->flashMessage('Uspesna operacia s komentarom.', 'success');
        $this->redirect('Dashboard:default');
    }
    
}