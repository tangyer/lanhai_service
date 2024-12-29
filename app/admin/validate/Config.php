<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class Config extends Validate
{
    protected $rule = [
//        'title|配置标题' => 'require',
//        'name|名称' => 'require',
        'value|配置值' => 'require',
//        'sort|排序' => 'require',
//        'group|分组' => 'require',
//        'description|配置说明' => 'require',
//        'status|状态' => 'require',
    ];
}
