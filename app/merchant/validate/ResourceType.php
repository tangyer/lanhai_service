<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class ResourceType extends Validate
{
    protected $rule = [
        'merchant_id|所属商户' => 'require',
        'type_name|分类名称' => 'require',
    ];
}
