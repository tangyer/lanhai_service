<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
use app\common\provider\CacheName;
use think\facade\Cache;

/**
 * @mixin \think\Model
 */
class Config extends BaseModel
{
     protected array $searchField = ['title','name','status'];

     protected string $sort = 'sort';

     protected string $sortOrder = 'desc';

    public static function onAfterWrite($model)
    {
        Cache::delete(CacheName::CONFIG);
    }

    public static function onAfterDelete($model)
    {
        Cache::delete(CacheName::CONFIG);
    }
}
