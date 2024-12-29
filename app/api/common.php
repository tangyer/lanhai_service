<?php

use app\common\provider\Result;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use think\facade\Cache;

// 这是系统自动生成的公共文件
if (!function_exists('param_build')) {
	/**
	 *
	 * 拼接签名字符串
	 * @param array $urlObj
	 *
	 * @return 返回已经拼接好的字符串
	 */
	function param_build($urlObj)
	{
		$buff = "";
		foreach ($urlObj as $k => $v)
		{
			if($k != "sign" && $k != "s"){
				$buff .= $k . "=" . $v . "&";
			}
		}
		$buff = trim($buff, "&");
		return $buff;
	}
}

if (!function_exists('create_jwt')){
	/**
	 * 生成jwt
	 * @param string $token
	 * @return string
	 */
	function create_jwt(string $token = ''): string
	{
		$time = time();
		$expire = $time + 86400;

		$key = config('config.tokenKey');
		$jwt_token = [
			'token'         => $token,
			'iss'           => '',
			'and'           => '',
			'nbf'           => $time,
			'iat'           => $time,
			'exp'           => $expire
		];
		return JWT::encode($jwt_token,$key,'HS256');
	}
}

if (!function_exists('verify_jwt')){
	/**
	 * 校验jwt
	 * @throws Exception
	 */
	function verify_jwt($jwt = '')
	{
		// 签发密钥
		$key = config('config.tokenKey');
		try {
			$jwtAuth = json_encode(JWT::decode($jwt,new Key($key,'HS256')));
			$authInfo = json_decode($jwtAuth,true);
			if (empty($authInfo['token'])) {
				throw new Exception('token_empty',Result::TOKEN_ERROR);
			}
			return $authInfo;
		} catch (\Firebase\JWT\ExpiredException $e) {
			throw new Exception('token_expired',Result::TOKEN_ERROR);
		} catch (\Exception $e) {
			throw new Exception('token_is_invalid',Result::TOKEN_ERROR);
		}
	}
}

if(!function_exists('pack_user_info')){

	/**
	 * 组装用户信息
	 * @param $type
	 * @return int
	 */
	function pack_user_info($member){
		$res = [];
		if($member) {
			$data['uid']             = $member['id'];
			$res['username']        = $member['username'];
			$res['nickname']        = $member['nickname'];
			$res['email']           = $member['email'];
			$res['mobile']          = $member['mobile'];
			$res['invite_code']     = $member['invite_code'];
			$res['level']           = $member['level'] ?: 1;
		}
		return $res;
	}
}

if (!function_exists('addLog')) {
	/**
	 * 添加记录日志
	 * @param $file_name  文件名
	 * @param $data 要记录的数据
	 * @param $extend 扩展信息
	 * @return void
	 */
	function addLog ($file_name, $data, $extend=[]) {
		if ($file_name && ($data || $extend)) {
			$file_path = ROOT_PATH.'api/log/'.$file_name.'/';
			!is_dir($file_path) && mkdir($file_path, 0755, true);

			file_put_contents($file_path.date('Ymd').'.log', "\n".json_encode($data).'  '.json_encode($extend), FILE_APPEND);
		}
	}
}

if (!function_exists('sysconfig')) {

    /**
     * 获取系统配置信息
     * @param $group
     * @param null $name
     * @return array|mixed
     */
    function sysconfig($group, $name = null)
    {
        $where = ['group' => $group];
        $value = empty($name) ? Cache::get("sysconfig_{$group}") : Cache::get("sysconfig_{$group}_{$name}");
        if (empty($value)) {
            if (!empty($name)) {
                $where['name'] = $name;
                $value = \app\admin\model\Config::where($where)->value('value');
                Cache::tag('sysconfig')->set("sysconfig_{$group}_{$name}", $value, 3600);
            } else {
                $value = \app\admin\model\Config::where($where)->column('value', 'name');
                Cache::tag('sysconfig')->set("sysconfig_{$group}", $value, 3600);
            }
        }
        return $value;
    }
}
