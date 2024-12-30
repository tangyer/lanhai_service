<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class Merchant extends Validate
{
    protected $rule = [
        'merchant_name|商户名称' => 'require',
        'platform_type|开通平台' => 'require',
        'port_num|端口数量' => 'require',
        'resource|素材权限' => 'require',
        'expire_time|到期时间' => 'require',
        'status|状态' => 'require',
    ];
}
