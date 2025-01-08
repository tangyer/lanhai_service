<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;
use think\facade\Cache;

class ActiveCode extends BaseLogic
{
    public function findOneByActiveCode($activeCode)
    {
        $model = $this->findOne(['active_code' => $activeCode]);
        if ($model){
            $model->expire_time = get_time($model->expire_time);
            unset($model->remark,$model->active_code_group_id);
        }
        return $model;
    }

    /**
     * 客户端登出
     * @param $token
     * @return true
     */
    public function quit($token): bool
    {
        // 清除token， 然后修改 token 登录的账户 为下线状态 ，并增加对应端口号
        Cache::delete($token);
//        \app\api\model\WorkOrderAccount::where(['token' => $token])->update([
//            'token' => '',
//            'online_status' => 0,
//            'port_status' => 0,
//            'offline_time' => time()
//        ]);
        return true;
    }
}
