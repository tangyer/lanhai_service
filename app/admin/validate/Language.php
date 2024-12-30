<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class Language extends Validate
{
    protected $rule = [
        'lang_name|语言名称' => 'require',
        'lang_code|语言编码' => 'require',
        'lang_sort|引擎排序' => 'require',
        'status|状态' => 'require',
    ];
}
