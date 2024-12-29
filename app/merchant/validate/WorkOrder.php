<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class WorkOrder extends Validate
{
    protected $rule = [
        'order_code|工单编号' => 'require',
        'active_code|激活码' => 'require',
        'order_name|工单名称' => 'require',
        'platform|工单类型' => 'require',
        'port_num|端口数' => 'require',
    ];
}
