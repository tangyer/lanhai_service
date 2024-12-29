<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;

class WorkOrderShare extends BaseLogic
{
    public function save(array $data = [])
    {
        $this->validate($data);

        $data['expire_time'] = strtotime($data['expire_time']);

        return parent::save($data);

    }
}
