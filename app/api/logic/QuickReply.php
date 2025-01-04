<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;
use think\db\Query;

class QuickReply extends BaseLogic
{
    public function getDesktopQuickReply(array $info)
    {
        $quickReplyData = (new \app\api\model\QuickReplyType())
            ->with(['quickReply' => function(Query $query){
                $query->field('reply_name,reply_type,content');
            }])
            ->field('id,type_name')
            ->where('merchant_id', $info['merchant_id'])
            ->select();
        if($quickReplyData->isEmpty()){
            return false;
        }
        $quickReplyData = $quickReplyData->toArray();
        foreach ($quickReplyData as $key => $item){
            foreach ($item['quickReply'] as $k => $value){
                $quickReplyData[$key]['quickReply'][$k]['content'] = explode(';',$value['content'],);
            }
        }
        return  $quickReplyData;
    }
}
