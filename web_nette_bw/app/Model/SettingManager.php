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
}
