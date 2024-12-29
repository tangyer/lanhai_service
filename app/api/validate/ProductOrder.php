<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class ProductOrder extends Validate
{
	protected $rule = [
		'productIdList'	=> 'require|array',
		'orderId' => 'require',
		'voucher' => 'require',
		'pay_kind' => 'require'
	];

	protected $scene = [
		'createOrder' => ['productIdList'],
		'paymentOrder' => ['orderId', 'voucher' , 'pay_kind']

	];

	protected $message = [
        'productIdList.require' => 'productIdList.require',
		'productIdList.array' => 'productIdList.array',
		'orderId.require' => 'orderId.require',
		'voucher.require' => 'voucher.require',
		'pay_kind.require' => 'pay_kind.require',
	];
}