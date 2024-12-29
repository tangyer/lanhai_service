<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrder extends BaseModel
{
     protected string $selectField = 'id,
                        customer_id,
                        order_code,
                        active_code,
                        order_name,
                        platform,
                        port_num,
                        port_use_num,
                        fans_target_num,
                        fans_num,
                        today_fans_num,
                        share_password,
                        share_expire_time,
                        clean_time,
                        reset_time,
                        status
               ';
}
