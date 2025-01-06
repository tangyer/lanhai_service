<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Resource extends BaseModel
{

     protected string $selectField = 'id,merchant_id,resource_name,resource_type,content';

      protected array $searchField = ['resource_name','resource_type'];

    protected $softDel = false;

    protected array $join = [
        ['resource_type', 'resource.resource_type = resource_type.id']
    ];
}
