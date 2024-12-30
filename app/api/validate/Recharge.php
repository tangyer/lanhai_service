<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class Recharge extends Validate
{
    protected $rule = [
        'amount' => 'require',
        'pay_type' => 'require',
    ];

    protected $message = [
        'amount.require' => 'recharge.amount_require',
        'pay_type.require' => 'recharge.pay_type_require'
    ];

    // 自定义验证规则
    protected function checkAmount($value, $rule, $data=[])
    {
        $minRecharge = get_config('recharge_min');
        if ($minRecharge < 0 && $value < $minRecharge){
            return lang('recharge.amount_min_error',['amount' => $minRecharge]) ;
        }
        return  true;

    }
}
