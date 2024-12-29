<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Dict extends BaseModel
{

     protected string $selectField = 'id,dict_sort,dict_label,dict_value,dict_type,css_class,list_class,is_default,status,create_time,remark';

      protected array $searchField = ['dict_label','dict_type','status'];

    protected $softDel = false;

    protected string $sort = 'dict_sort';
    protected string $sortOrder = 'asc';
}
