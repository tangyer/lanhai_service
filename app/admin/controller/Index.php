<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\admin\logic\Node;
use think\response\Json;
use app\admin\logic\User;

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
     * @param User $user
     * @return string|Json
     * @author Wuqc
     * @Time: 2022/11/20 19:47
     */
    public function resetPwd(User $user){
        if (IS_POST){
            $id = get_user_id();
            $password = $this->request->post('password','123456');
            $user->resetPassword((int)$id,$password);
            return  $this->success($this->request->post());
        }

        return $this->fetch('reset_pwd',['user' => get_user()]);
    }

    /**
     * 充值提现统计
     * @return Json
     * @throws \think\db\exception\DbException
     * @author ZZZN
     * @Time: 2023/6/20 16:42
     */
    public function autoGetTip()
    {
        $rechargeAlert = (new \app\admin\model\Recharge())->where(['status'=>0])->count();
        $withdrawalAlert = (new \app\admin\model\Withdraw())->where(['status'=>0])->count();
        
        $rechargeT = (new \app\admin\model\Recharge())->where(['status'=>0])->where('create_time','>',time()-60)->count();
        $withdrawalT = (new \app\admin\model\Withdraw())->where(['status'=>0])->where('create_time','>',time()-60)->count();
        
        $tipData = [
            'rechargeAlert' => $rechargeAlert,
            'withdrawalAlert' => $withdrawalAlert,
            'rechargeT' => $rechargeT,
            'withdrawalT' => $withdrawalT,
        ];

        return $this->success($tipData);
    }
}
