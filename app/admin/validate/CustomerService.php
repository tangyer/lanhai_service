<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class CustomerService extends Validate
{
    protected $rule = [
        'name|客服名称' => 'require',
        'icon|图标' => 'require',
        'value|联系方式' => 'require',
        'url|跳转链接' => 'require',
    ];
}
