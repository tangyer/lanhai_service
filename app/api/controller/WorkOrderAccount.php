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
        $active_code = $params['code'] ?? 0; // 激活码
        $online_status = $params['online_status'] ?? ''; // 状态 0 主动离线 1 在线  2 批量下线
        $last_login_time = $params['last_login_time'] ?? date('Y-m-d H:i:s'); // 下线时间
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

    /**
     * 更新上线时间以及登录状态
     * @return Json
     */
    public function updateMainAccount(\app\api\logic\WorkOrderAccount $workOrderAccount): Json
    {
        $params = $this->getInput();
        $user_id = $params['user_id'] ?? ''; //登录账号，手机号
        $online_status = $params['online_status'] ?? 0; // 登录状态 1 登录  0 登出
        $login_time = $params['login_time'] ?? time(); // 登录时间
        $port_status = $online_status == 1 ? 1 : 0 ; // 占用端口
        $last_login_time = $params['last_login_time'] ?? time(); // 最后登录时间
        if(!$user_id || !is_numeric($online_status)){
            return $this->error(Result::PARAM_ERROR,'参数错误');
        }
        $result = $workOrderAccount->updateMainAccount([
            'account_mobile' => $user_id,
            'online_status' => $online_status,
            'login_time' => $login_time,
            'port_status' => $port_status,
            'last_login_time' => $last_login_time
        ]);
        if (!$result) return $this->error(Result::FAIL_ERROR,'操作失败');
        return $this->success();
    }
}
