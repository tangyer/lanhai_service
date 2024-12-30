<?php
declare (strict_types = 1);

namespace app\common\validate;
use think\Validate;

class MemberAccountRecord extends Validate
{
    protected $rule = [
        'relation_id'   => 'require',
        'member_id'     => 'require',
        'trans_type'    => 'require',
        'amount'        => 'require',
    ];

    protected $message = [
        'relation_id.require' => 'relation_id_require',
        'member_id.require'   => 'member_id_require',
        'currency.require'    => 'currency_require',
        'account_type.require'=> 'account_type_require',
        'trans_type.require'  => 'trans_type_require',
        'amount.require'      => 'amount_require',
    ];
}
