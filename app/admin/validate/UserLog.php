<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class UserLog extends Validate
{
    protected $rule = [
        'user_id|用户ID' => 'require',
        'username|用户名' => 'require',
        'ip|' => 'require',
    ];
}
