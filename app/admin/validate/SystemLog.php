<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class SystemLog extends Validate
{
    protected $rule = [
        'username|用户名' => 'require',
        'title|操作标题' => 'require',
        'method|操作方法' => 'require',
        'params|请求参数' => 'require',
        'ip|IP地址' => 'require',
    ];
}
