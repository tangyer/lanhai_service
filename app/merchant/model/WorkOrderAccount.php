<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrderAccount extends BaseModel
{
    // 设置字段类型
    protected $type = [
        'online_time' => 'timestamp:Y-m-d H:i:s',
        'offline_time' => 'timestamp:Y-m-d H:i:s'
    ];
     protected string $selectField = 'id,merchant_id,active_code,order_code,account_name,account_mobile,account_id,online_status,port_status,fans_target_num,fans_num,today_fans_repeat_num,fans_repeat_num,today_fans_num,today_fans_target_num,online_time,offline_time,account_link,token';

      protected array $searchField = ['merchant_id','active_code','order_code','account_mobile','online_status','port_status'];


}
