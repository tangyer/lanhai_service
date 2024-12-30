<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class TranslateEngine extends BaseModel
{

     protected string $selectField = 'id,engine_name,engine_code,engine_type,engine_sort,status';

      protected array $searchField = ['engine_name','engine_code','engine_type','status'];

    
}
