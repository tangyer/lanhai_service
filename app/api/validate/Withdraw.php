<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class Withdraw extends Validate
{
    protected $rule = [
        'amount'            => 'require',
        'trade_password'    => 'require',
//        'name'              => 'require',
        'account'           => 'require',
//        'bank_code'         => 'require',
//        'mobile'            => 'require',
//        'email'             => 'require',
//        'pay_type'          => 'require',
//        'usdt'    => 'require',
    ];

    protected $message = [
        'amount.require' => 'withdraw.amount_require',
        'trade_password.require' => 'trade_password_require',
    ];
}
