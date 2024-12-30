<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class TranslateEngine extends Validate
{
    protected $rule = [
        'engine_name|引擎名称' => 'require',
        'engine_code|引擎编码' => 'require',
    ];
}
