<?php
declare (strict_types = 1);

namespace app\admin\validate;
use think\Validate;

class Banner extends Validate
{
    protected $rule = [
        'pos|位置: index_top=首页顶部' => 'require',
        'title|标题名称' => 'require',
        'image|图片' => 'require',
        'url|链接' => 'require',
        'sort|排序' => 'require',
    ];
}
