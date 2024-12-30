<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class KeywordType extends Validate
{
    protected $rule = [
        'type_name|分类名称' => 'require',
    ];
}
