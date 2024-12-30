<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class DictType extends Validate
{
    protected $rule = [
        'dict_name|字典名称' => 'require',
        'dict_type|字典类型' => 'require',
        'status|状态' => 'require',
    ];
}
