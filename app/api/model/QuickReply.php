<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class QuickReply extends BaseModel
{

     protected string $selectField = 'id,merchant_id,reply_name,reply_type,content';

     

    protected $softDel = false;

}
