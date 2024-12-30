<?php
declare (strict_types = 1);

namespace app\api\controller;


use app\common\provider\Result;
use think\response\Json;

class WorkOrderAccount extends Base
{
    /**
     * 批量下线
     * @return Json
     */
    public function batchOffline(\app\api\logic\WorkOrderAccount $workOrderAccount)
    {
        $params = $this->getInput();
        $active_code = $params['code'] ?? 0;
        $online_status = $params['online_status'] ?? '';
        $last_login_time = $params['last_login_time'] ?? date('Y-m-d H:i:s');
        if (!$active_code || !$last_login_time) {
            return $this->error(Result::PARAM_ERROR,'参数错误');
        }
        $result = $workOrderAccount->updateBatchOffline([
            'active_code' => $active_code,
            'online_status' => $online_status,
            'offline_time' => strtotime($last_login_time)
        ]);
        if(!$result) $this->error(Result::FAIL_ERROR,'操作失败');
        return $this->success();
    }

    /**
     * 根据主号获取粉丝数据
     * @return Json
     */
    public function getFansRecord(\app\api\logic\WorkOrderAccount $workOrderAccount): Json
    {
        $params = $this->getInput();
        $user_id = $params['user_id'] ?? 0;
        if (!$user_id) return $this->error(Result::PARAM_ERROR,'参数错误');
        $fansRecord = $workOrderAccount->findOne(['account_code' => $user_id]);
        return $this->success([
            'news_fans_number' => $fansRecord->today_fans_num, // 当日置零后进粉总数
            'repeat_fans_number' => $fansRecord->today_fans_repeat_num, // 当日置零后重粉总数
            'all_new_fans_number' => $fansRecord->fans_num - $fansRecord->fans_repeat_num, // 新粉数
            'all_repeat_fans_number' => $fansRecord->fans_repeat_num, // 重粉数
            'all_fans_number' => $fansRecord->fans_num // 全部粉丝数
        ]);
    }
}
