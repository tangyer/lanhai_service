<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ActiveCodeGroup extends BaseModel
{

     protected string $selectField = 'id,merchant_id,group_name,remark,status,create_user,create_time';

      protected array $searchField = ['merchant_id','group_name','status'];

    
}
