<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrderAccount extends BaseModel
{
    // 设置字段类型
    protected $type = [
        'online_time' => 'timestamp:Y-m-d H:i:s',
        'offline_time' => 'timestamp:Y-m-d H:i:s'
    ];
}
