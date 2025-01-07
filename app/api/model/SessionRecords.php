<?php
declare (strict_types = 1);

namespace app\api\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class SessionRecords extends BaseModel
{

     protected string $selectField = 'id,sessionId,userId,token,platform,order_code,active_code';

     

    protected $softDel = false;
}
