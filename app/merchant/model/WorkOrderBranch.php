<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrderBranch extends BaseModel
{

     protected string $selectField = 'id,merchant_id,order_code,link_type,short_link,status';

      protected array $searchField = ['merchant_id','order_code','link_type','status'];

    
}
