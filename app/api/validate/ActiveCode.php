<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class ActiveCode extends Validate
{
    protected $rule = [
        'merchant_id|商户ID' => 'require',
        'active_code|激活码' => 'require',
        'active_code_group_id|所属分组' => 'require',
        'expire_time|失效时间' => 'require',
        'platform|使用平台' => 'require',
        'remark|备注' => 'require',
        'content|说明' => 'require',
        'status|状态' => 'require',
    ];
}
