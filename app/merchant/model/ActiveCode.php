<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ActiveCode extends BaseModel
{

    protected string $aliasName = 'ac';

     protected string $selectField = 'id,merchant_id,active_code,active_code_group_id,active_code_group.group_name,port_num,expire_time,clean_time,platform,remark,content,status,create_user,create_time';

     protected array $searchField = ['merchant_id','active_code','active_code_group_id','platform'];

    protected array $join = [
        ['active_code_group' , 'active_code_group.id = ac.active_code_group_id']
    ];


}
