<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require',
        'image|图片' => 'require',
        'sort|排序' => 'require',
        'status|状态: 1 正常 0禁用' => 'require',
    ];
}
