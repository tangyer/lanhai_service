<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrder extends BaseModel
{

     protected string $selectField = 'id,merchant_id,order_code,active_code,order_name,platform,port_num,port_use_num,port_online_num,fans_num,fans_repeat_num,today_fans_num,clean_time,status,create_time';

      protected array $searchField = ['merchant_id','order_code','active_code','order_name','platform'];

    
}
