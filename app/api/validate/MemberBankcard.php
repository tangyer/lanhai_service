<?php
declare (strict_types = 1);

namespace app\api\validate;
use think\Validate;

class MemberBankcard extends Validate
{
    protected $rule = [
        'member_id' => 'require',
        'kind'      => 'require',
//        'name' => 'require',
//        'bank' => 'require',
        'account' => 'require',
    ];
}
