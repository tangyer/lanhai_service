<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class QuickReply extends BaseModel
{

     protected string $selectField = 'id,merchant_id,reply_name,reply_type,content,quickReplyType.type_name';

      protected array $searchField = ['reply_name','reply_type','content'];

    protected $softDel = false;

    protected array $join = [
        ['quickReplyType', 'QuickReply.reply_type = quickReplyType.id']
    ];
}
