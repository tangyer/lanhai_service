<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\provider\Result;
use app\common\traits\ApiAction;
use think\facade\Cache;
use think\response\Json;

class QuickReply extends Base
{
    use ApiAction;

    public function getDesktopQuickReply(\app\api\logic\QuickReply $quickReply): Json
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $result = $quickReply->getDesktopQuickReply($info);

        return $this->success($result);
    }
}