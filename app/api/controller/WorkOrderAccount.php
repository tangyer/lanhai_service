<?php
declare (strict_types = 1);

namespace app\api\controller;


use app\common\provider\Result;
use think\facade\Cache;
use think\facade\Log;
use think\response\Json;

class WorkOrderAccount extends Base
{
    /**
     * 添加主账号信息
     * @return Json
     */
    public function addMainAccount(\app\api\logic\WorkOrderAccount $workOrderAccount)
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $phone_number = $params['phone_number'] ?? ''; // 手机号
        $nick_name = $params['nickname'] ?? ''; // 昵称
        $platform_id = $params['platform_id'] ?? ''; // 平台
        $link = $params['link'] ?? '';// 主号链接
        $order_number = $params['order_number'] ?? ''; // 工单号
        $user_id = $params['user_id'] ?? ''; // 账号
        $sessionId = $params['sessionId'] ?? ''; // 会话ID
        if (!$phone_number || !$nick_name || !$link || !$order_number || !$user_id || !$sessionId) {
            return $this->error(Result::PARAM_ERROR,'参数错误');
        }
        $result = $workOrderAccount->addMainAccount([
            'account_mobile' => $phone_number,
            'account_name' => $nick_name,
            'order_code' => $order_number,
            'account_id' => $user_id,
            'account_link' => $link,
            'merchant_id' => $info['merchant_id'],
            'active_code' => $info['active_code'],
            'token' => $token,
        ], $sessionId);
        if(!$result) return $this->error(Result::FAIL_ERROR,'操作失败');

        return $this->success();
    }

    /**
     * 批量下线
     * @return Json
     */
    public function batchOffline(\app\api\logic\WorkOrderAccount $workOrderAccount)
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
//        $active_code = $params['code'] ?? 0; // 激活码
//        $online_status = $params['online_status'] ?? ''; // 状态 0 离线
//        $last_login_time = $params['last_login_time'] ?? date('Y-m-d H:i:s'); // 下线时间
        $sessionId = $params['sessionId'] ?? []; // 会话id
        $order_code = $params['order_number'] ?? '';
        if (!$sessionId) {
            return $this->success();
        }
        $result = $workOrderAccount->updateBatchOffline([
            'sessionId' => $sessionId,
            'order_code' => $order_code,
            'token' => $token,
            'active_code' => $info['active_code']
        ]);
        trace('批量下线', 'log'.'-----------'.$result);
        if(!$result) return $this->error(Result::FAIL_ERROR,'操作失败');
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
        try {
            $fansRecord = $workOrderAccount->findOne(['account_id' => $user_id]);

        }catch (\Exception $e){
            return $this->success([
                'news_fans_number' => 0, // 当日置零后进粉总数
                'repeat_fans_number' => 0, // 当日置零后重粉总数
                'all_new_fans_number' => 0, // 新粉数
                'all_repeat_fans_number' => 0, // 重粉数
                'all_fans_number' => 0 // 全部粉丝数
        ]);
        }

        return $this->success([
            'news_fans_number' => $fansRecord->today_fans_num ?? 0, // 当日置零后进粉总数
            'repeat_fans_number' => $fansRecord->today_fans_repeat_num ?? 0, // 当日置零后重粉总数
            'all_new_fans_number' => $fansRecord->fans_num - $fansRecord->fans_repeat_num, // 新粉数
            'all_repeat_fans_number' => $fansRecord->fans_repeat_num ?? 0, // 重粉数
            'all_fans_number' => $fansRecord->fans_num ?? 0 // 全部粉丝数
        ]);
    }

    /**
     * 根据主号获取粉丝数据
     * @return Json
     */
    public function getFansStatias(\app\api\logic\WorkOrder $workOrder): Json
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $platform = strtolower($params['platform']) ?? '';
        $order_code = $params['order_number'] ?? '';
        if (!$platform) return $this->error(Result::PARAM_ERROR,'参数错误');
        try {
            $fansRecord = $workOrder->findOne(['order_code' => $order_code,'platform' => $platform]);
        }catch (\Exception $e){
            return $this->success([
                'new_fans_number' => 0, // 当日置零后进粉总数
                'repeat_fans_number' => 0, // 当日置零后重粉总数
                'all_fans_number' => 0, //  工单重置后进粉总数
                'all_repeat_fans_number' => 0, // 工单重置后重粉总数
            ]);
        }
        return $this->success([
            'new_fans_number' => $fansRecord->today_fans_num ?? 0, // 当日置零后进粉总数
            'repeat_fans_number' => $fansRecord->today_fans_repeat_num ?? 0, // 当日置零后重粉总数
            'all_fans_number' => $fansRecord->fans_num ?? 0, //  工单重置后进粉总数
            'all_repeat_fans_number' => $fansRecord->fans_repeat_num ?? 0, // 工单重置后重粉总数
        ]);
    }

    /**
     * 更新上线时间以及登录状态
     * @return Json
     */
    public function updateMainAccount(\app\api\logic\WorkOrderAccount $workOrderAccount): Json
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $sessionId = $params['sessionId'] ?? ''; // 会话id
        $user_id = $params['user_id'] ?? ''; //登录账号，手机号
        $online_status = $params['online_status'] == 1 ? 1 : 0; // 登录状态 1 登录  0 登出
        $login_time = $params['login_time'] ?? time(); // 登录时间
        $port_status = $online_status == 1 ? 1 : 0 ; // 占用端口
        $last_login_time = $params['last_login_time'] ?? time(); // 最后登录时间
        if(!$user_id || !$sessionId){
            return $this->error(Result::PARAM_ERROR,'参数错误');
        }
        $result = $workOrderAccount->updateMainAccount([
            'account_id' => $user_id,
            'online_status' => $online_status,
            'login_time' => $login_time,
            'port_status' => $port_status,
            'last_login_time' => $last_login_time
        ], $sessionId);

        if (!$result) return $this->error(Result::FAIL_ERROR,'操作失败');
        return $this->success();
    }

    /**
     * 创建会话/删除会话
     * @return Json
     */
    public function conversation()
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');

    }
}
