<?php
declare (strict_types = 1);

namespace app\merchant\validate;
use think\Validate;

class WorkOrderBranch extends Validate
{
    protected $rule = [
        'order_code|工单编号' => 'require',
        'link_type|短链平台' => 'require',
        'short_link|短链接' => 'requireIf:link_type,customize',
        'status|状态' => 'require',
    ];
}
