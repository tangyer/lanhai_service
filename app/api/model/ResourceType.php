<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class ResourceType extends BaseModel
{

     protected string $selectField = 'id,merchant_id,type_name';

     

    protected $softDel = false;
}
