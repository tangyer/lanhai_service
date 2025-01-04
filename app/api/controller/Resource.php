<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\provider\Result;
use app\common\traits\ApiAction;
use think\facade\Cache;
use think\response\Json;

class Resource extends Base
{
    use ApiAction;

    public function getDesktopQuickReply(\app\api\logic\Resource $resource): Json
    {
        $token = $this->request->header('token');
        $info = Cache::get($token);
        if(!$info) return $this->error(Result::TOKEN_ERROR,'身份验证错误');
        $result = $resource->getAll(['merchant_id' => $info['merchant_id']]);

        return $this->success($result);
    }
}
