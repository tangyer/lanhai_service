<?php

namespace app\common\traits;

trait AuthModel
{
    public function generatePassword(string $password){
        $this->salt     = generate_rand_str();
        $this->password = generate_password($password,$this->salt);
    }

    public function generateToken(){
        $this->token = md5(generate_rand_str(16).time());
    }

    /**
     * 验证密码
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password = ''): bool
    {
        return $this->password === generate_password($password,$this->salt);
    }

    /**
     * 当天剩余登录次数 限制5次
     * @return int
     */
    public function getFailTimes(): int
    {
        if(get_date() == get_date($this->last_login_time) ){
            return  5 - $this->fail_times;
        }
        return 5;
    }

    /**
     *添加错误次数
     * @return bool
     */
    public function addFailTimes(): bool
    {
        $this->last_login_time = time();
        $this->fail_times ++;
        return $this->save();
    }

    /**
     * 生成邀请码
     */
    public function generateInviteCode(): int
    {
        $code = random_int(100000,999999);
        if ($this->getCount(['invite_code' => $code]) > 0){
            return $this->generateInviteCode();
        }
        $this->invite_code = $code;

        return $code;
    }
}