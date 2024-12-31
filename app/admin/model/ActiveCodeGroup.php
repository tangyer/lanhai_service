<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ActiveCodeGroup extends BaseModel
{

     protected string $selectField = 'id,merchant_id,group_name,status,remark,create_time,merchant.merchant_name,active_code.active_code';

      protected array $searchField = ['merchant_id','group_name','status','merchant.merchant_name|like','active_code.active_code'];

    protected array $join = [
        ['merchant' , 'merchant.id = ActiveCodeGroup.merchant_id'],
        ['active_code' , 'ActiveCodeGroup.id = active_code.active_code_group_id']
    ];
}
