<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Language extends BaseModel
{

     protected string $selectField = 'lang_name,lang_code';

     

    
}
