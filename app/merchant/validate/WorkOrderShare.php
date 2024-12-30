<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class WorkOrderShare extends Validate
{
    protected $rule = [
        'merchant_id|商户ID' => 'require',
        'order_code|工单编号' => 'require',
        'link_type|短链平台' => 'require',
        'expire_time|到期时间' => 'require',
        'password|分享密码' => 'require',
    ];
}
