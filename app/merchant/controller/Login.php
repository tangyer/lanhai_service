<?php

namespace app\merchant\controller;

use app\common\provider\Result;
use app\merchant\logic\MerchantUser;
use think\captcha\facade\Captcha;
use think\response\Json;
use think\response\Redirect;

class Login extends Base
{
    /**
     * 后台登录页面
     * @return string
     * @author Wuqc
     * @Time: 2022/11/20 19:24
     */
    public function index(){
        $this->assign('ctx',$this->request->root());
        $this->layout(false);
        return $this->fetch();
    }


    /**
     * @param MerchantUser $user
     * @return Json
     * @author Wuqc
     * @Time: 2022/11/20 19:30
     */
    public function login(MerchantUser $user)
    {
        if ($this->request->isAjax()) {
           $user->login($this->request);
           return $this->success();
        }
        return  $this->error(Result::DATA_NOT_ERROR,'用户名或密码错误');
    }


    /**
     * 验证码
     * @author Wuqc
     * @Time: 2022/11/20 19:25
     */
    public function captcha(){
        return Captcha::create();
    }

    /**
     * 登出
     * @return Redirect
     * @author Wuqc
     * @Time: 2022/11/20 19:31
     */
    public function logout()
    {
        session(null);
        return redirect($this->request->root());
    }
}