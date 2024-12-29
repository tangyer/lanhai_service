<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\merchant\logic\Node;

class Index extends Base
{
    public function index(Node $node)
    {
        $this->layout(false);
        $this->assign('nodes',$node->getTreeNodeByPerms());
        $this->assign('users',get_user());
        return $this->fetch();
    }

    /**
     * 首页内容
     * @return string
     * @author Wuqc
     * @Time: 2022/11/20 19:45
     */
    public function main( ){

        return $this->fetch();
    }

    /**
     * 修改登录密码
     * @author Wuqc
     * @Time: 2022/11/20 19:47
     */
    public function resetPwd(\app\merchant\logic\MerchantUser $user){
        if (IS_POST){
            $id = get_user_id();
            $password = $this->request->post('password','123456');
            $user->resetPassword((int)$id,$password);
            session(null);
            return  $this->success();

        }

        return $this->fetch('reset_pwd',['user' => get_user()]);
    }


}
