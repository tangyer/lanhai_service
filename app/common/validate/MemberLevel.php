<?php
declare (strict_types = 1);

namespace app\common\validate;
use think\Validate;

class MemberLevel extends Validate
{
    protected $rule = [
        'level|等级' => 'require',
        'title|名称' => 'require',
        'icon|图标' => 'require',
        'image|图片' => 'require',
        'commission_rate|佣金比例' => 'require',
        'order_num|订单数量' => 'require',
        'upgrade_amount|升级余额' => 'require',
    ];
}
