<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Language extends BaseModel
{

     protected string $selectField = 'id,lang_name,lang_code,lang_sort,status';

      protected array $searchField = ['lang_name','lang_code','status'];

    
}
