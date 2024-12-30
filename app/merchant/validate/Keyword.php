<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class Keyword extends Validate
{
    protected $rule = [
        'keyword|敏感词' => 'require',
        'keyword_type|分类' => 'require',
        'is_refuse|拒绝发送' => 'require',
    ];
}
