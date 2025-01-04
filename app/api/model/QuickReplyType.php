<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class QuickReplyType extends BaseModel
{

     protected string $selectField = 'id,merchant_id,type_name';

     

    protected $softDel = false;

    public function quickReply()
    {
        return $this->hasMany(quickReply::class,'reply_type');
    }
}
