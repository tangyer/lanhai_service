<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class MerchantUser extends Validate
{
    protected $rule = [
        'merchant_id|商户ID' => 'require',
        'username|登入账号' => 'require',
        'password|登录密码' => 'require',
        'status|状态' => 'require',
    ];
}
