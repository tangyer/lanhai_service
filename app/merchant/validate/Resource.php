<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class Resource extends Validate
{
    protected $rule = [
        'resource_name|素材名称' => 'require',
        'resource_type|素材类型' => 'require',
        'content|内容' => 'require'
    ];
}
