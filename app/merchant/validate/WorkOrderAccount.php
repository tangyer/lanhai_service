<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class WorkOrderAccount extends Validate
{
    protected $rule = [
        'merchant_id|商户ID' => 'require',
        'active_code|激活码' => 'require',
        'order_code|工单编号' => 'require',
        'account_name|账户' => 'require',
        'account_mobile|手机号' => 'require',
//        'account_id|账户ID' => 'require',
    ];
}
