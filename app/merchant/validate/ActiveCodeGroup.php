<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class ActiveCodeGroup extends Validate
{
    protected $rule = [
        'merchant_id|所属商户' => 'require',
        'group_name|分组名称' => 'require',
        'remark|备注' => 'require',
        'status|状态' => 'require',
    ];
}
