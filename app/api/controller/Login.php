<?php

namespace app\api\controller;

use app\common\provider\Result;
use think\facade\Cache;

class Login extends Base
{
    public function index(\app\api\logic\ActiveCode $activeCode,\app\api\logic\WorkOrder $workOrder){
        $input = $this->getInput();
        $code = $input['code'] ?? '';
        if (!$code) return $this->error(Result::PARAM_ERROR,'参数错误');
        $model = $activeCode->findOneByActiveCode($code);
        if(strtotime($model->expire_time) < time()){
            return $this->error(Result::FAIL_ERROR,'激活码已过期');
        }
        $model->content_permission = true;
        $model->access_token = md5($model->active_code.random_int(1000,9999).time());
        Cache::set($model->access_token,$model->toArray(),86400);
        return $this->success([
            'accessToken' => $model->access_token,
            'platformId' => $model->platform,
            'orderNumber' => $workOrder->getAllByActiveCode($code),
            'activationCode' => $code,
            'createTime' => $model->create_time,
            'expirationTime' => $model->expire_time,
            'portNumber' => $model->port_number,
            'contentPermissions' => $model->content_permission
        ]);
    }

    public function logout(\app\api\logic\ActiveCode $activeCode)
    {
        // 清除token， 然后修改 token 登录的账户 为下线状态 ，并增加对应端口号
        $token = $this->request->header('token');

        $activeCode->quit($token);
        return $this->success();
    }
}