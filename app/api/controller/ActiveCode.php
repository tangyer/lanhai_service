<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\provider\Result;
use app\common\traits\AdminAction;
use think\Exception;
use think\facade\Cache;
use think\response\Json;

class ActiveCode extends Base
{
    /**
     * 获取在线/占用/分配端口数
     * @return Json
     */
    public function portInfo(\app\api\model\WorkOrder $workOrder): Json
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');

        $workOrderInfo = $workOrder->field('active_code,SUM(port_use_num) port_use_num,SUM(port_online_num) port_online_num')
            ->where(['active_code' => $info['active_code']])
            ->group('active_code')
            ->find();
        return $this->success([
            'online_ports' => $workOrderInfo['port_online_num'] ?? 0,
            'used_ports' => $workOrderInfo['port_use_num'] ?? 0,
            'ports' => $info['port_num'] ?? 0,
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
