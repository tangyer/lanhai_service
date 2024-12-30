<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class WorkOrderAccount extends BaseModel
{
    //protected string $selectField = 'order_code,online_status';

    protected array $searchField = ['order_code','online_status','port_status'];
}
