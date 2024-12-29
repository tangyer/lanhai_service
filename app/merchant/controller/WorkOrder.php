<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\provider\Result;
use app\common\traits\MerchantAction;
use think\response\Json;

class WorkOrder extends Base
{
    use MerchantAction;


    public function index(): mixed
    {
        if (IS_AJAX){

            return $this->success($this->logic->getList($this->getParams())->toArray());
        }
        return $this->fetch('index',$this->getParams());
    }

    /**
     * 重置工单
     */
    public function reset(): Json
    {
        if (IS_POST){
            $this->logic->reset($this->getParams());
            return $this->success();
        }
        return $this->error(Result::METHOD_ERROR);
    }

    /**
     * 工单粉丝列表
     */
    public function fansList(\app\merchant\logic\WorkOrderFans $fans){
        if (IS_AJAX){
            return $this->success($fans->getList($this->getParams())->toArray());
        }

        return $this->fetch('fans_list',[
            'model' =>$this->logic->findOne($this->getParams()),
            'order_code' => $this->request->param('order_code')
        ]);
    }

}
