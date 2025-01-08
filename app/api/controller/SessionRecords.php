<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\provider\Result;
use app\common\traits\ApiAction;
use think\facade\Cache;

class SessionRecords extends Base
{
    use ApiAction;

    /**
     * @param \app\api\model\WorkOrder $workOrder
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 会话是否可以创建
     */
    public function isCreatSession()
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $input = $this->getInput();
        $platform = $input['platformId'] ?? '';
        if(!$platform) return $this->error(Result::TOKEN_ERROR,'参数错误');

        $workOrderInfo = (new \app\api\model\WorkOrder())->where(['active_code' => $info['active_code']])
            ->where('platform' ,$platform)
            ->find();
        if(empty($workOrderInfo)) return $this->error(Result::TOKEN_ERROR,'请核对激活码');
        if($workOrderInfo->port_num > $workOrderInfo->port_use_num){
            return $this->success(['status'=>1]);
        }else{
            return $this->success(['status'=>0]);
        }
    }

    /**
     * @param \app\api\logic\SessionRecords $sessionRecords
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 创建会话
     */
    public function createSession(\app\api\logic\SessionRecords $sessionRecords)
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $input = $this->getInput();

        $platform = $input['platformId'] ?? '';
        $sessionId = $input['sessionId'] ?? '';

        if(!$platform || !$sessionId) return $this->error(Result::TOKEN_ERROR,'参数错误');

        // 插入数据
        $res = $sessionRecords->createSession(['token'=>$token,'platform'=>$platform,'sessionId'=>$sessionId,'active_code'=>$info['active_code']]);

        return $this->success($res);
    }

    /**
     * @param \app\api\logic\SessionRecords $sessionRecords
     * @return \think\response\Json
     * 删除会话
     */
    public function deleteSession(\app\api\logic\SessionRecords $sessionRecords)
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $input = $this->getInput();

        $sessionId = $input['sessionId'] ?? '';
        if(!$sessionId) return $this->error(Result::TOKEN_ERROR,'参数错误');

        // 删除会话
        $res = $sessionRecords->deleteSession(['sessionId'=>$sessionId]);

        return $this->success($res);
    }

    /**
     * @param \app\api\logic\SessionRecords $sessionRecords
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 批量删除会话
     */
    public function deleteAllSession(\app\api\logic\SessionRecords $sessionRecords)
    {
        $input = $this->getInput();
        $sessionId = $input['sessionId'] ?? [];
        $code = $input['code'] ?? '';

        foreach ($sessionId as $v){
            $sessionRecords->deleteSessionBySessionId($v,$code);
        }

        return $this->success();
    }
}
