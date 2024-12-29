<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ActiveCode extends BaseModel
{

     protected string $selectField = 'id,merchant_id,active_code,active_code_group_id,port_num,expire_time,platform,remark,content,status,create_time';

     protected array $searchField = ['merchant_id','active_code','platform'];
}
