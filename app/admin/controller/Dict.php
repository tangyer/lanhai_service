<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\common\traits\AdminAction;

class Dict extends Base
{
    use AdminAction;

    public function index(\app\admin\logic\DictType $dictType){
        if (IS_AJAX){
            return $this->success($this->logic->getList($this->request->param())->toArray());
        }
        return $this->fetch('index',[
            'dict_type' => $this->request->param('dict_type'),
            'type_list' => $dictType->getAll()
        ]);

    }

    public function create(){
        return $this->fetch('create',[
            'dict_type' => $this->request->param('dict_type')
        ]);
    }
}
