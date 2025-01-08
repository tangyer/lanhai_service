<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\common\traits\MerchantAction;

class KeywordType extends Base
{
    use MerchantAction;

    public function getAll(){
        return $this->success($this->logic->getAll($this->getParams())->toArray());
    }

}
