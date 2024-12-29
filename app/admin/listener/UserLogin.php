<?php
declare (strict_types = 1);

namespace app\admin\listener;

use app\admin\model\User;
use app\admin\model\UserLog;
use think\facade\Session;

class UserLogin
{
    /**
     * 用户登录事件监听处理
     *
     * @return mixed
     */
    public function handle(User $user,UserLog $userLog)
    {
        //创建session
        Session::set('user',[
            'id' => $user->id,
            'username' => $user->username,
            'realname' => $user->realname,
            'role_id' => $user->role_id,
            'token' => $user->token
        ]);
        $user->last_login_time = time();
        $user->last_login_ip = ip2long(request()->ip());
        $user->save();
        //添加登录日志
        $userLog->save([
            'user_id'      => $user->id,
            'username'     => $user->username,
            'create_time'  => time(),
            'ip'           => request()->ip(),
        ]);

    }
}
