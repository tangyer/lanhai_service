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

    public function updatePortNum(string $order_code, int $num = 1, bool $op = true)
    {
        $info = $this->findOne(['order_code' => $order_code]);
        if($op){
            $info->port_use_num += $num;
            $info->port_online_num += $num;
        }else{
            $info->port_use_num -= $num;
            $info->port_online_num -= $num;
        }
        $info->save();
        return true;
    }

}
