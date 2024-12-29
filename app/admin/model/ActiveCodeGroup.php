<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ActiveCodeGroup extends BaseModel
{

     protected string $selectField = 'id,merchant_id,active_code,group_name,status,remark,create_time';

      protected array $searchField = ['merchant_id','active_code','group_name','status'];

    
}
