<?php

namespace app\admin\controller;

use app\common\traits\AdminAction;

class Node extends Base
{
    use AdminAction;

    public function create(){
        return $this->fetch('create',[
            'app_type' => $this->request->param('app_type')
        ]);
    }
}