<?php
declare (strict_types = 1);

namespace app\admin\logic;
use app\admin\validate\MerchantUser;
use app\common\logic\BaseLogic;
use think\exception\ValidateException;

class Merchant extends BaseLogic
{
    public function getList(array $where = []){
        return $this->model->getList($where)->each(function($item, $key){
            $item->expire_time = date('Y-m-d' , $item->expire_time);
        });
    }

    public function save(array $data){
        $this->validate($data);
        $data['platform_type'] = implode(',', $data['platform_type']);
        $data['expire_time'] = strtotime($data['expire_time']);
        $id = $data['id'] ?? 0;
        if ($id){
            $this->update($data);
        }else{

            validate(MerchantUser::class)->check($data['user']);
            $user = $data['user'];
            $count = \app\admin\model\MerchantUser::where(['username' => $user['username']])->count();
            if ($count > 0){
                throw  new ValidateException('登录帐号已存在');
            }
            // 创建商户
            $this->model->save($data);
            $user['merchant_id'] = $this->model->id;
            $user['realname'] = $data['merchant_name'];
            $salt = generate_rand_str();
            $user['salt'] = $salt;
            $password = $user['password'] ?? '123456';
            $user['password'] = generate_password($password,$salt);
            $user['token'] = generate_token();
            $user['role_id'] = 1;
            $user['status'] = 1;
            $user['create_time'] = time();
            //创建商户用户
            \app\admin\model\MerchantUser::create($user);
        }

        return true;

    }
}
