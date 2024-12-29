<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class CustomerService extends BaseModel
{
     protected array $searchField = ['name'];
}
