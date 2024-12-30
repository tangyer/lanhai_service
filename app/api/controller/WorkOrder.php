<?php
declare (strict_types = 1);

namespace app\api\controller;

class WorkOrder extends Base
{
    /**
     * @param \app\merchant\logic\WorkOrderFans $fans
     * @return \think\response\Json
     */
    public function fansList(\app\merchant\logic\WorkOrderFans $fans){

        if ($this->request->isAjax()){
            // 获取连接中的工单号
            $url = $_SERVER['REQUEST_URI'];
            $urlArr = explode('/', $url);
            $orderCode = array_pop($urlArr);

            return $this->success($fans->getList(['order_code'=>$orderCode])->toArray());
        }

        return $this->fetch();
    }
}
