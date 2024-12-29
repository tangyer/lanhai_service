<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;

class WorkOrder extends BaseLogic
{
    public function getAllByActiveCode($activeCode)
    {
        return $this->getAll(['active_code' => $activeCode]);
    }

    /**
     * 根据激活码 获取在线/占用/分配端口数
     * @param $activeCode
     * @return void
     */
    public function getPortByActiveCode($activeCode)
    {
//       根据激活码 获取在线/占用/分配端口数
        $list =  $this->getAll(['active_code' => $activeCode]);

    }

}
