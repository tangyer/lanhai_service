<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\provider\Result;
use app\common\traits\ApiAction;
use think\facade\Cache;
use think\response\Json;

class WorkOrderFans extends Base
{
    use ApiAction;

    /**
     * 获取粉丝信息
     * @return Json
     */
    public function getFansInfo(\app\api\logic\WorkOrderFans $workOrderFans): Json
    {
        $params = $this->getInput();
        $fans_account = $params['fans_account'] ?? ''; // 用户名/粉丝账号
        $user_id = $params['user_id'] ?? ''; // 主账号
        $activation_code = $params['activation_code'] ?? ''; // 激活码
        if(!$fans_account || !$user_id || !$activation_code){
            $this->error(Result::PARAM_ERROR,'参数错误');
        }
        $result = $workOrderFans->findOne([
            'fans_account_code' => $fans_account,
            'order_account_id' =>  $user_id,
            'active_code' => $activation_code
        ]);
        return  $this->success([
            'fans_username' => $result->fans_account_name,
            'fans_nickname' => $result->fans_account_name,
            'fans_label' => $result->fans_flag,
            'fans_mark' => $result->remark
        ]);
    }

    /**
     * 添加粉丝记录（用户注册）
     * @return Json
     */
    public function register(\app\api\logic\WorkOrderFans $workOrderFans): Json
    {
        $params = $this->getInput();
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $data = [
            'fans_account_id' => $params['platform_id'] ?? '', // 平台id
            'order_account_id' => $params['main_account'] ?? '', // 主账号
            'order_code' => $params['order_number'] ?? '', // 工单号
            'contact' => $params['contact'] ?? '', // 联系方式
            'fans_mobile' => $params['fans_phone'] ?? '', // 手机号
        ];
        $result = $workOrderFans->register($info, $data);
        if (!$result) return $this->error(Result::FAIL_ERROR,'操作失败');
        return $this->success();
    }

    /**
     * 保存粉丝信息
     * @return Json
     */
    public function updateFansInfo(\app\api\logic\WorkOrderFans $workOrderFans): Json
    {
        $params = $this->getInput();
        $fans_account = $params['fans_account'] ?? ''; // 用户名/粉丝账号
        $user_id = $params['user_id'] ?? ''; // 主账号
        $activation_code = $params['activation_code'] ?? ''; // 激活码
        $fans_account_name = $params['fans_account_name'] ?? ''; // 粉丝名称
        $fans_label = $params['fans_label'] ?? ''; // 粉丝标签
        $fans_remark = $params['fans_remark'] ?? ''; // 粉丝备注
        if(!$fans_account || !$user_id || !$activation_code){
            $this->error(Result::PARAM_ERROR,'参数错误');
        }
        $result = $workOrderFans->updateFansInfo([
            'fans_account_code' => $fans_account,
            'order_account_id' =>  $user_id,
            'active_code' => $activation_code,
            'fans_account_name' => $fans_account_name,
            'fans_flag' => $fans_label,
            'remark' => $fans_remark
        ]);
        if (!$result) return $this->error(Result::FAIL_ERROR,'操作失败');
        return  $this->success();
    }

}
