<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class QuickReply extends BaseModel
{
    protected string $aliasName = 'qr';

     protected string $selectField = 'id,merchant_id,reply_name,reply_type,content,quick_reply_type.type_name';

      protected array $searchField = ['reply_name','reply_type','content','merchant_id'];

    protected $softDel = false;

    protected array $join = [
        ['quick_reply_type', 'qr.reply_type = quick_reply_type.id']
    ];
}
