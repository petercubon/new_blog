<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components;
use App\FrontModule\Presenters\BasePresenter;
use App\Model\CommentManager;
use App\Model\DashboardManager;
use App\Model\PostManager;
use Nette\Application\UI\Form;
use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;

abstract class PostPresenter extends Presenter
{
    use Components\Comments\Add\PresenterTrait;

    use Components\Comments\Grid\ControlTrait;

//    use Components\Comments\Grid\Item\ControlMultipleTrait;

    // MANIPULACIA S PRISPEVKAMI
    use Components\Post\Manipulate\PresenterTrait;

    // POSTCONTROLFACTORY na zobrazenie jedneho clanku
    use Components\Post\Detail\PresenterTrait;

    // otherPost
    use Components\Post\Detail\OtherPosts\PresenterTrait;

//    private $post;
    private $canCreateCommentGrid;
    private $canCreateCommentForm;
//    private $canCreatePostDetailControl = null;
    private $canCreatePostForm;

    public function __construct(
        private CommentManager $commentManager,
        private PostManager $postManager,
        private Components\Post\Manipulate\FormFactory $formFactory,
        private DashboardManager $dashboardManager,
        private Components\Post\Detail\ControlFactory $controlDetailFactory,
        private Explorer $db,
    ){
        parent::__construct(); // volanie rodicovskeho constructoru
    }

    // POSTPRESENTER
    // MANIPULACIA S PRISPEVKAMI

    // ACTION ADD POST
//    public function actionAdd()
//    {
//        $this->checkPrivilege();
//    }

    public function actionAdd(): void
    {
        $this->checkPrivilege('post', 'add');

        $this->canCreatePostForm = true;
    }

    // ACTION EDIT POST
//    public function actionEdit(int $postId): void
//    {
//        $this->checkPrivilege();
//
//        $post = $this->dashboardManager->getById($postId);
//
//        if (!$post){
//            $this->error('Zadany clanok nebol najdeny.', 404);
//        }
//
//        $this->entity = $post->toArray();
//    }

    public function actionEdit(int $postId): void
    {
        $post = $this->checkPostExistence($postId);

        $this->checkPrivilege($this->postManager->wrapToEntity($post), 'edit');

        $this->entity = $post->toArray();

        $this->canCreatePostForm = true;
    }

    //  SUCCEEDED
    public function postFormSucceeded(Form $form, array $data): void
    {
        if (!$this->getUser()->isLoggedIn()){
            $this->error('Pre vytvorenie, alebo editaciu prispevku je nutne sa prihlasit.');
        }

        $this->flashMessage('Prispevok bol uspesne publikovany');
        $this->redirect('show', $data['id']);
    }

    public function actionShow(int $postId): void
    {
        $this->checkPrivilege('post', 'view');

        $this->postId = $postId;

        $this->post = $this->postManager->wrapToEntity($this->checkPostExistence($postId));

        // obmedzenie zobrazenia casti, ktore nemusia byt pristupne pre uzivatela pridacajuceho novy Post
        $this->canCreateCommentGrid         = $this->getUser()->isAllowed('commentGrid', 'view');
        $this->canCreateCommentForm         = $this->getUser()->isAllowed('comment', 'add');
        $this->canCreatePostDetailControl   = true; // uz je overene vyssie pomocou checkPrivilege metody
    }

    public function renderShow(int $postId): void
    {
        $this->template->post = $this->postManager->getOnePost($postId);
    }

    public function checkPostExistence(int $postId): ActiveRow
    {
        $post = $this->postManager->getById($postId);

        if (!$post){
            $this->error('Ospravedlnujeme sa, ale vami zadany prispevok neexituje.', 404);
        }

        return $post;
    }

}