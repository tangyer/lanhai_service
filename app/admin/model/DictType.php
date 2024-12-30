<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class DictType extends BaseModel
{

     protected string $selectField = 'id,dict_name,dict_type,status,create_time,remark';

     protected array $searchField = ['dict_name','dict_type'];

     protected $softDel = false;
}
