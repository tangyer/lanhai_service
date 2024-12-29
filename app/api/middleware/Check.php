<?php
declare (strict_types = 1);

namespace app\api\middleware;

use app\common\provider\Result;
use think\facade\Config;

class Check
{
	/**
	 * 处理请求
	 *
	 */
	public function handle($request, \Closure $next)
	{
//        if (!$this->ignore($request->pathinfo())){
//            $result = $this->checkToken($request->param());
//            if($result['code'] != Result::SUCCESS){
//                return Result::error($result['code'],$result['msg']);
//            }
//        }
        return $next($request);
	}


	/**
	 * 验证 Sign
	 * @param array $arr
	 * @return array
	 */
	protected function checkToken(array $arr = []): array
	{
		$result = [];
		$result['code'] = Result::SUCCESS;
		$result['msg']  = '';
		if (empty($arr['sign'])) {
			$result['code'] = Result::SIGN_ERROR;
			$result['msg'] = lang('sign_error');
			return $result;
		}
		$sign = $arr['sign'];
		ksort($arr);
		$signStr = param_build($arr);
		$service_sign = strtoupper(md5($signStr .Config::get('config.signKey')));
		if ($sign !== $service_sign) {
			$result['code'] = Result::SIGN_ERROR;
//			$result['msg'] = lang('sign_error');
			$result['msg'] = 'sign_error 正确的sign为：'.$service_sign;
			return $result;
		}
		return $result;
	}

    private function ignore(string $path = ''): bool
    {
        $data = [
            'personal/upload',
            'index/invitation',
            'order/paynotify',
            'order/cashnotify'
        ];
        return in_array($path,$data);
    }
}
