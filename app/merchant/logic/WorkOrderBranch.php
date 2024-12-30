<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;

class WorkOrderBranch extends BaseLogic
{
    public function save(array $data = [])
    {
        $this->validate($data);

        if ($data['link_type'] == 'boss'){
            $data['short_link'] = request()->domain().'/api/Share/shunt/'.$data['order_code'];
        }

        return parent::save($data);

    }
}
