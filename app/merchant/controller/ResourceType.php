<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\traits\MerchantAction;

class ResourceType extends Base
{
    use MerchantAction;

    public function all(){
        return $this->success($this->logic->getAll($this->getParams())->toArray());
    }
}
