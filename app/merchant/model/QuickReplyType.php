<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class QuickReplyType extends BaseModel
{

     protected string $selectField = 'id,merchant_id,type_name';

      protected array $searchField = ['type_name','merchant_id'];

    protected $softDel = false;
}
