<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;

class WorkOrderAccount extends BaseLogic
{
    /**
     * 批量下线
     * @return Bool
     */
    public function updateBatchOffline(array $params): bool
    {
        $data = [
            'online_status' => $params['online_status'],
            'offline_time' => $params['offline_time']
        ];
        $result = (new \app\api\model\WorkOrderAccount())->where(['active_code' => $params['active_code']])->update($data);
        if(!$result) return false;
        return true;
    }

    /**
     * 更新上线时间以及登录状态
     * @return Bool
     */
    public function updateMainAccount(array $params): bool
    {
        $info = $this->findOne(['account_mobile' => $params['account_mobile']]);
        $info->online_status = $params['online_status'];
        $info->online_time = !empty($params['last_login_time']) ? $params['last_login_time'] : $params['login_time'];
        $info->port_status = $params['port_status'];
        $result = $info->save();
        if(!$result) return false;
        return true;
    }
}
