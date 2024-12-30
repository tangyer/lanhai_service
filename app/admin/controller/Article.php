<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\common\traits\AdminAction;

class Article extends Base
{
    use AdminAction;

    public function save(){
        if(IS_POST){
            $data = $this->request->param();
            unset($data['content']);
            $data['content'] = $this->request->param('content', null, null);
            $this->logic->save($data);
            return $this->success() ;
        }
    }
}
