<?php

declare(strict_types=1);

namespace App\Model;

use http\Encoding\Stream\Inflate;
use Nette\Security\Permission;
use Nette\StaticClass;

class AuthorizatorFactory
{
    use StaticClass;

    public static function create(): Permission
    {
        $acl = new Permission();

        $acl->addRole('guest');
        $acl->addRole('user', 'guest'); // user dedi vsetko od guest
        $acl->addRole('moderator', 'user');
        $acl->addRole('admin');

        $acl->addResource('front');         // view, logout, register
        $acl->addResource('admin');         // view, logout

        $acl->addResource('postGrid');      // view
        $acl->addResource('post');          // view, add, edit, delete
        $acl->addResource('commentGrid');   // view
        $acl->addResource('comment');       // view, add, edit, delete
        $acl->addResource('otherPosts');    // view
        $acl->addResource('addNewDevice');  // view, add
        $acl->addResource('showDevices');   // view
        $acl->addResource('device');        // delete
        $acl->addResource('consumption');   // add, edit, delete

        // guest (bez prihlasenia)
        $acl->deny('guest'); // nemoze vykonat nic
        $acl->allow('guest', 'front', 'view');
        $acl->allow('guest', 'postGrid', 'view');
        $acl->allow('guest', 'post', 'view');
        $acl->allow('guest', 'commentGrid', 'view');
        $acl->allow('guest', 'comment', 'view');
        $acl->allow('guest', 'otherPosts', 'view');

        $acl->allow('user', 'comment', 'add');
        // callback overi, ci ide o autora
        $acl->allow('user', 'comment', 'edit',      [self::class, 'checkResourceManipulateAsAuthor']);
        $acl->allow('user', 'comment', 'delete',    [self::class, 'checkCommentDelete']);
        $acl->allow('user', 'front', 'logout');
        $acl->allow('user', 'addNewDevice', 'view');
        $acl->allow('user', 'addNewDevice', 'add');
        $acl->allow('user', 'showDevices', 'view');
        $acl->allow('user', 'showDevices', 'edit');
        $acl->allow('user', 'showDevices', 'delete');
        $acl->allow('user', 'device', 'delete', [self::class, 'checkResourceManipulateAsAuthor']);
        $acl->allow('user', 'consumption', 'delete', [self::class, 'checkResourceManipulateAsAuthor']);

        $acl->allow('moderator', 'post', 'add'); // len moderator pridava nove prispevky
        // odosle staticku metodu checkEditPostS ako callback, edit zavola callback (funkciu checkEditPostS)
        $acl->allow('moderator', 'post', 'edit',    [self::class, 'checkResourceManipulateAsAuthor']);
        $acl->allow('moderator', 'post', 'delete',  [self::class, 'checkResourceManipulateAsAuthor']);
        $acl->allow('moderator', 'admin', 'view');
        $acl->allow('moderator', 'admin', 'logout');
        $acl->allow('moderator', 'otherPosts', 'delete');


        $acl->allow('admin'); // admin moze vsetko

        $acl->isAllowed();
        return $acl;
    }

    // overenie ci je mozne s danou Resource manipulovat ako jej autor
    public static function checkResourceManipulateAsAuthor(Permission $acl, string $role, string $resource, string $privilege): bool
    {
        $role = $acl->getQueriedRole(); // rola je objekt
        $resource = $acl->getQueriedResource(); // zdroj je objekt
        return $role->getUserId() === $resource->author_id;
//        return $role->getUserId() === $resource->getConsumptionAuthorId();
    }

    // mazanie komantaru pri clanku, kde som autorom clanku
    public static function checkCommentDelete(Permission $acl, string $role, string $resource, string $privilege): bool
    {
        $queriedRole = $acl->getQueriedRole(); // rola je objekt
        $queriedResource = $acl->getQueriedResource(); // zdroj je objekt
        // overenie autora ci ide o jeho clanok a moze tak vymazat komentar pri clanku
        return self::checkResourceManipulateAsAuthor($acl, $role, $resource, $privilege) || $queriedRole->getUserId() === $queriedResource->getPostAuthorId();
    }

    // Edit Post
    public static function checkEditPost (Permission $acl, string $role, string $resource, string $privilege): bool
    {
        $role = $acl->getQueriedRole(); // rola je objekt
        $resource = $acl->getQueriedResource(); // zdroj je objekt
        return $role->getUserId() === $resource->getAuthorId(); // porovnanie z role ID autora a z resource ID autora
    }


}