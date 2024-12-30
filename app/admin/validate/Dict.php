<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class Dict extends Validate
{
    protected $rule = [
        'dict_sort|字典排序' => 'require',
        'dict_label|字典标签' => 'require',
        'dict_value|字典键值' => 'require',
        'dict_type|字典类型' => 'require',
        'list_class|表格回显样式' => 'require',
        'is_default|是否默认' => 'require',
        'status|状态' => 'require',
    ];
}
