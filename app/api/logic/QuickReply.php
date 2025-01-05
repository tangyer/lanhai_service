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
        $resultData = [];
        $quickReplyData = $quickReplyData->toArray();
        // 返回数据格式处理
        foreach ($quickReplyData as $key => $item){
            $resultData[$key]['name'] = $item['type_name'];
            foreach ($item['quickReply'] as $k => $value){
                $resultData[$key]['quick_reply_content'][$k]['name'] = $value['reply_name'];
                $content = explode(';',$value['content']);
                foreach ($content as $k1 => $val){
                    $resultData[$key]['quick_reply_content'][$k]['text'][$k1]['content'] = $val;
                    $resultData[$key]['quick_reply_content'][$k]['text'][$k1]['type'] = 'wz';
                }
            }
        }
        return  $resultData;
    }
}
