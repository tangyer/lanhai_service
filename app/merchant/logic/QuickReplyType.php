<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;

class QuickReplyType extends BaseLogic
{
    /**
     * 添加数据
     * @param array $data
     * @return bool
     */
    public function create(array $data = []): bool
    {
        $this->validate($data);
        return $this->model->save($data);
    }
}
