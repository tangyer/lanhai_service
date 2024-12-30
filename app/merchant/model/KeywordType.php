<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class KeywordType extends BaseModel
{

     protected string $selectField = 'id,merchant_id,type_name,create_time';

      protected array $searchField = ['merchant_id','type_name'];

    protected $softDel = false;
}
