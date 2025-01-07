<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ActiveCode extends BaseModel
{
    protected string $aliasName = 'ac';
    // 设置字段类型
    protected $type = [
        'expire_time' => 'timestamp:Y-m-d H:i:s'
    ];
     protected string $selectField = 'id,merchant_id,active_code,active_code_group_id,port_num,expire_time,platform,remark,content,status,create_time,merchant.merchant_name,active_code_group.group_name';

     protected array $searchField = ['merchant_id','active_code','platform','merchant.merchant_name'];

    protected array $join = [
        ['merchant' , 'merchant.id = ac.merchant_id'],
        ['active_code_group' , 'active_code_group.id = ac.active_code_group_id']
    ];
}
