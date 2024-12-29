<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class OrderRecharge extends Validate
{
	protected $rule = [
		'amount'    => 'require'
	];
}