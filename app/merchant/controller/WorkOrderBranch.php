<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\traits\MerchantAction;

class WorkOrderBranch extends Base
{
    use MerchantAction;

    public function detail(){
        $model = $this->logic->findOne($this->getParams(),false);
        if ($model){
            return $this->fetch('detail',[
                'model'=>$model
            ]);
        }
        return $this->fetch('create',[
            'order_code' => $this->request->get('order_code'),
        ]);
    }

}
