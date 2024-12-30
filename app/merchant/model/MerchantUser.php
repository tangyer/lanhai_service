<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class MerchantUser extends BaseModel
{

     protected string $selectField = 'id,merchant_id,username,password,salt,token,role_id,last_login_time,last_login_ip,fail_times,status,create_time';

      protected array $searchField = ['merchant_id','username','status'];

    public function generatePassword(string $password): void
    {
        $this->salt     = generate_rand_str();
        $this->password = generate_password($password,$this->salt);
    }

    public function generateToken(): void
    {
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
}
