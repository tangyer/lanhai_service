<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class WorkOrderFans extends Validate
{
    protected $rule = [
        'merchant_id|商户ID' => 'require',
        'active_code|激活码' => 'require',
        'order_code|工单编号' => 'require',
        'order_account_id|主帐号' => 'require',
        'fans_account_code|用户名' => 'require',
        'fans_mobile|手机号' => 'require',
//        'fans_account_id|账户ID' => 'require',
//        'fans_account_name|账户名称' => 'require',
    ];
}
