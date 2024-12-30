<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class WorkOrder extends Validate
{
    protected $rule = [
        'customer_id|商户ID' => 'require',
        'order_code|工单编号' => 'require',
        'active_code|激活码' => 'require',
        'order_name|工单名称' => 'require',
        'platform|工单类型' => 'require',
        'port_number|帐号总数' => 'require',
        'port_online_number|在线帐号' => 'require',
        'fans_target_number|目标总数' => 'require',
        'fans_number|进粉总数' => 'require',
        'fans_repeat_number|重复粉数' => 'require',
        'today_fans_number|当日进粉数' => 'require',
        'share_password|分享密码' => 'require',
        'share_expire_time|失效时间' => 'require',
        'clean_time|清零时间' => 'require',
        'reset_time|重置时间' => 'require',
        'status|状态：' => 'require',
    ];
}
