<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\traits\AdminAction;
use think\facade\Cache;
use think\response\Json;

class ActiveCode extends Base
{
    public function portInfo(): Json
    {
        return $this->success([
            'online_ports' => 1,
            'used_ports' => 2,
            'ports' => 10
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
