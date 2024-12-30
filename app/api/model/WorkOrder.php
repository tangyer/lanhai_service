<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
use think\db\exception\BindParamException;

/**
 * @mixin \think\Model
 */
class WorkOrder extends BaseModel
{
     protected string $selectField = 'id,
                        order_code,
                        active_code,
                        order_name,
                        platform,
                        port_num,
                        port_use_num,
                        fans_target_num,
                        fans_num,
                        today_fans_num,
                        clean_time,
                        status
               ';
     protected array $searchField = ['active_code'];
}
