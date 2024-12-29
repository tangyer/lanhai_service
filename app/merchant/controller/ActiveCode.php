<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\traits\MerchantAction;

class ActiveCode extends Base
{
    use MerchantAction;

//    public function index()
//    {
//        dd(generate_rand_str(10,6));
//    }

    public function create()
    {
        return $this->fetch('create',[
            'port_num' => get_user('port_num'),
            'platform' => explode(',',get_user('platform')),
        ]);
    }

    public function update($id){
        $model = $this->findModel($id);
        return $this->fetch('update',[
            'model' =>  $model,
            'platform' => explode(',',get_user('platform')),
        ]);
    }

}
