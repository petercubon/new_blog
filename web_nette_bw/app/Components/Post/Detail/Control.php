<?php

declare(strict_types=1);

namespace App\Components\Post\Detail;

use App\Model\Entity\PostResource;
use App\Model\Entity\Resource;
use App\Model\PostManager;
use Closure;
use Nette\Database\Table\ActiveRow;
use Nette\Security\User;

class Control extends \Nette\Application\UI\Control
{
    private $post;

    public function __construct(
        private PostResource $item,
        private Closure $onDelete,
        private PostManager $manager,
        private User $user,
    ) { }

    public function render(): void
    {
        $this->template->item = $this->item;

        $this->template->render(__DIR__ . '/default.latte');
    }

    // metoda na zmazanie clanku
    public function handleDelete(): void
    {
        $isAllowedToDeleteThis = ($this->user->isAllowed($this->item, 'delete'));

        if ($isAllowedToDeleteThis){
            $this->manager->delete($this->item->id);
        }

        // Closure do zatvoriek a zavolanie Closure
        // inak hlasi chybu, ze Control nema funckiu onDelete
        // ako parameter Callbacku je povolenie na mazanie
        ($this->onDelete)($isAllowedToDeleteThis);
    }
}