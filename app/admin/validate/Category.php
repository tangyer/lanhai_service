<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cate_name|类型名称' => 'require',
//        'icon|图标' => 'require',
//        'cate_type|分类类型' => 'require',
    ];
}
