<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Resource extends BaseModel
{

     protected string $selectField = 'id,merchant_id,resource_name,resource_type,content,resourceType.type_name';

     protected $softDel = false;

    protected array $join = [
        ['resourceType', 'Resource.resource_type = resourceType.id']
    ];
}
