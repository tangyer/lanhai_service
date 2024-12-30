<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrderFans extends BaseModel
{

     protected string $selectField = 'id,merchant_id,active_code,order_code,order_account_id,fans_account_code,fans_mobile,fans_account_id,fans_account_name,fans_type,fans_flag,country,create_time,reset_status,remark';

     

    
}
