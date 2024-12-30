<?php

namespace app\admin\validate;

use think\Validate;

class MerchantUser extends Validate
{
    protected $rule = [
        'username|登入账号' => 'require',
        'password|登录密码' => 'require',
    ];
}