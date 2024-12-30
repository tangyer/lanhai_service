<?php
declare (strict_types = 1);

namespace app\admin\logic;
use app\common\logic\BaseLogic;
use app\common\provider\CacheName;
use think\facade\Cache;

class Language extends BaseLogic
{
    public function after(): void
    {
        Cache::delete(CacheName::LANGUAGE);
    }
}
