<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\traits\MerchantAction;

class WorkOrderShare extends Base
{
    use MerchantAction;

    public function index(){
        $model = $this->logic->findOne($this->getParams(),false);
        if ($model){
            $model->link = $this->request->domain().'/api/WorkOrder/fansList/'.$model->order_code; //
            return $this->fetch('detail',[
                'model'=>$model
            ]);
        }
        return $this->fetch('create',[
            'order_code' => $this->request->get('order_code'),
            'password' => generate_rand_str()
        ]);
    }
}
