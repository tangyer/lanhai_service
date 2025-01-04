<?php
declare (strict_types = 1);

namespace app\admin\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Merchant extends BaseModel
{
    protected string $aliasName = 'merchant';

    protected array $searchField = ['merchant_name'];

    protected string $selectField = 'merchant.*,merchant_user.username';

    protected array $join = [
        ['merchant_user' , 'merchant.id = merchant_user.merchant_id','left']
    ];
}
