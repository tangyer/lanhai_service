<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class TranslateEngine extends Validate
{
    protected $rule = [
        'engine_name|引擎名称' => 'require',
        'engine_code|引擎编码' => 'require',
        'engine_type|引擎类型' => 'require',
        'engine_sort|引擎排序' => 'require',
        'status|状态' => 'require',
    ];
}
