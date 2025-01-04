<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class QuickReplyType extends Validate
{
    protected $rule = [
        'type_name|分组名称' => 'require',
    ];
}
