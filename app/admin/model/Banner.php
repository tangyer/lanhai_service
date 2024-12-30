<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Banner extends BaseModel
{
     protected array $searchField = ['title','lang'];
}
