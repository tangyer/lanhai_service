<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class ActiveCode extends Validate
{
    protected $rule = [
        'merchant_id|商户ID' => 'require',
        'active_code_group_id|所属分组' => 'require',
        'port_num|分配端口' => 'require',
        'expire_time|失效时间' => 'require',
        'platform|使用平台' => 'require',
        'status|状态' => 'require',
        'create_user|创建人' => 'require',
    ];
}
