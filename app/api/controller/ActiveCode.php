<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\traits\AdminAction;
use think\facade\Cache;
use think\response\Json;

class ActiveCode extends Base
{
    /**
     * 获取在线/占用/分配端口数
     * @return Json
     */
    public function portInfo(\app\api\logic\WorkOrder $workOrder): Json
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        $workOrderInfo = $workOrder->findOne(['active_code' => $info['active_code'], 'platform' => $info['platform']]);
        return $this->success([
            'online_ports' => $workOrderInfo['port_online_num'] ?? 0,
            'used_ports' => $workOrderInfo['port_use_num'] ?? 0,
            'ports' => $workOrderInfo['port_num'] ?? 0,
        ]);
    }

    public function port(\app\api\logic\WorkOrder $workOrder): Json
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        $workOrder->getAll(['active_code' => $info['active_code']]);
        return $this->success($info);
    }
}
