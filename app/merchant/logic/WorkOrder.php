<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;
use think\facade\Validate;

class WorkOrder extends BaseLogic
{
    /**
     *  重置工单
     * @param array $params
     * @return true
     */
    public function reset(array $params = []){

        // 重置工单
        $model = $this->findOne($params);
        $model->fans_num = 0;
        $model->fans_repeat_num = 0;
        $model->today_fans_num = 0;
        $model->save();

        // 重置工单账户
        \app\merchant\model\WorkOrderAccount::update([
            'fans_num' => 0,
            'today_fans_repeat_num' => 0,
            'fans_repeat_num' => 0,
            'today_fans_num' => 0,
        ],['order_code' => $model->order_code]);

        // 重置粉丝 不能删除 仅商户可看
        \app\merchant\model\WorkOrderFans::update([
            'reset_status' => 1
        ],['order_code' => $model->order_code]);

        return true;

    }




}
