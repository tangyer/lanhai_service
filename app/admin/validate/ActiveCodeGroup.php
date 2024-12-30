<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class ActiveCodeGroup extends Validate
{
    protected $rule = [
        'merchant_id|所属商户' => 'require',
        'active_code|激活码' => 'require',
        'group_name|分组名称' => 'require',
        'status|状态' => 'require',
    ];
}
