<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class TranslateEngine extends BaseModel
{
     protected string $selectField = 'id,engine_code,engine_name';
}
