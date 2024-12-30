<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrderShare extends BaseModel
{

     protected string $selectField = 'id,merchant_id,order_code,link_type,expire_time,password,status';

      protected array $searchField = ['merchant_id','order_code','status'];

    
}
