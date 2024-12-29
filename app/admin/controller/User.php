<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\common\provider\Result;
use app\common\traits\AdminAction;
use think\response\Json;

class User extends Base
{
    use AdminAction;

    /**
     * 重置用户密码
     * @return string|Json
     */
    public function resetPwd(){
        if (IS_POST){
            $id = $this->request->post('id/d');
            $password = $this->request->post('password');
            $this->logic->resetPassword((int)$id,$password);
            return  $this->success();
        }

        $user = $this->logic->findOneById((int) $this->request->get('id/d',0));
        return $this->fetch('reset_pwd',['user' => $user]);
    }
}
