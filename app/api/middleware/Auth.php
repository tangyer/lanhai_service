<?php
declare (strict_types = 1);

namespace app\api\middleware;
use app\api\model\Member;
use app\common\provider\Result;
use Closure;
use think\Request;
use think\response\Json;

class Auth
{
	/**
	 * 处理请求
	 *
	 * @param Request $request
	 * @param Closure $next
	 * @return mixed|Json
	 */
	public function handle(Request $request,Closure $next)
	{
        $token = $request->header('token');
        if (empty($token)) {
            return Result::error(Result::TOKEN_ERROR, lang('token_empty'));
        }
        try {
            if($info = verify_jwt($token)){
                $jwtToken  = $info['token'] ?? '';
                $member = new \app\api\logic\Member();
                $model = $member->findByToken($jwtToken);
                if(!$model){
                    return Result::error(Result::TOKEN_ERROR, lang('token_error'));
                }
                $request->member = $model;
                setMemberOnline($model->id);
            }
        } catch (\Exception $e) {
            return Result::error(Result::TOKEN_ERROR,$e->getMessage().$e->getLine());
        }
		return  $next($request);
	}




}
