<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class User extends BaseModel
{
    protected string $aliasName = 'user';

    protected array $searchField = ['username','realname|like'];

    protected string $selectField = 'id,username,realname,mobile,role.role_name,last_login_time,last_login_ip,status,create_time,fail_times';

    protected array $join = [
        ['role' , 'role.id = user.role_id']
    ];

    /**
     * 关联角色
     * @return mixed
     */
    public function role(){
        return $this->hasOne(Role::class,'id','role_id');
    }

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
}
