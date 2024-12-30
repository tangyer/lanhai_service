<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Merchant extends BaseModel
{

     protected string $selectField = 'id,merchant_name,platform_type,port_num,resource,expire_time,status,remark,create_time';

      protected array $searchField = ['merchant_name','platform_type','status'];

    
}
