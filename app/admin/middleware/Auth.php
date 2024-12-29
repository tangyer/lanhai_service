<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use app\admin\logic\SystemLog;
use app\common\provider\Request;
use app\common\provider\Result;
use think\facade\Env;
use think\facade\Log;
use think\Response;

class Auth
{
    /**
     * 处理请求
     *
     * @param Request $request
     * @param \Closure $next
     * @return Response
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $user = get_user();
        if (!$user && !str_contains($request->url(), 'login')){
            return redirect(url('login/index')->build());
        }
        if($request->isPost()){
            if(!empty($user)){
                (new SystemLog())->create([
                    'username' => $user['username'],
                    'title' =>  $request->url(),
                    'method' => $request->url(),
                    'params' => json_encode($request->post()),
                    'ip'    => getRealIP(),
                ]);
            }
        }
        return  $next($request);

    }
}
