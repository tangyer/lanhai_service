<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class Member extends Validate
{
	protected $rule = [
		'mobile'            => 'require',
        'username'          => 'require',
        'invite_code'       => 'require',
		'password'          => 'require',//必须是字母数字，可以加特殊字符 ,'regex:^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z!@#$\%\^\&\*\(\)]{6,16}'
        'trade_password'    => 'require',
		'country_code'      => 'require',
		'code'      => 'require',
	];

	protected $scene = [
		'login'             => ['email','password'],
		// 'register'          => ['mobile','username','password','trade_password','invite_code'],
		// 'register'          => ['email','code','password'],
		'register'          => ['email', 'password'],

	];

	protected $message = [
        'username.min' => 'reg.username_min_error', // 用户名格式 为字母加数字
		'email.require' => 'email_require_error',
		'code.code' => 'email_format_error',
		'password.require' => 'password_require_error'
	];

	// public function sceneLogin()
	// {
	// 	return $this->only(['mobile','password'])
	// 		->remove('password', 'regex');
	// }
}