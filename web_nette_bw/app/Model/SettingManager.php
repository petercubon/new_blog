<?php

declare(strict_types=1);

namespace App\Model;

use http\Encoding\Stream\Inflate;
use Nette\Database\Explorer;
use Nette\SmartObject;
use Nette\Caching\Storage;
use Nette\Caching\Cache;

class SettingManager extends BaseManager
{

    // zoznam Properties
    /**
     * Class SettingManager
     * @package App\Model
     *
     * @property-read string $emailSender;
     * @property-read string $emailReceiver;
     */

    use SmartObject;

    private Cache $cache;

    public function __construct(
        protected Explorer $db,
        Storage $storage, // interface (nema prefix ani sufix)
        )
    {
        $this->cache = new Cache($storage, 'Setting');
    }

    public function getTableName(): string
    {
        return 'setting';
    }

    // na ziskanie hodnot EmailSender a EmailReceiver len jedna metoda
    // vysledky tejto metody ukladat do cache
    public function getEmailSender(): string
    {
        return $this->getAll()
            ->get('EMAIL_SENDER')
            ->value;
    }

    public function getEmailReceiver(): string
    {
        return $this->getAll()
            ->get('EMAIL_RECEIVER')
            ->value;
    }

//    public function getEmailSenderOrReceiver(string $setting): string
//    {
//        $value = $this->getAll()
//            ->get($setting)
//            ->value;
//
//        $retVal = $this->cache->load('EMAIL_SENDER', function ($value = null){
//            return $value;
//        });
//
//        return $value;
//    }

}
