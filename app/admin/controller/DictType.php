<?php
declare (strict_types = 1);

namespace app\admin\controller;
use app\common\traits\AdminAction;

class DictType extends Base
{
    use AdminAction;

    public function all()
    {
        return $this->success($this->logic->getAll(['status' => 1])->toArray());
    }
}
