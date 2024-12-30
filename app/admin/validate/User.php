<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username|登入账号' => 'require',
        'password|登录密码' => 'require',
        'realname|真实姓名' => 'require',
        'mobile|电话' => 'require',
        'role_id|角色' => 'require',
    ];

    protected $scene = [
        'edit'  =>  ['username','realname','mobile'],
    ];
}
