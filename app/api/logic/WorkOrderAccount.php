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
        $info = $this->findOne(['active_code' => $params['active_code']]);
        $info->online_status = $params['online_status'];
        $info->offline_time = $params['offline_time'];
        $result = $info->save();
        if(!$result) return false;
        return true;
    }
}
