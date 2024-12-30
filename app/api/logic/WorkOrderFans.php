<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;

class WorkOrderFans extends BaseLogic
{
    /**
     * 添加粉丝记录（用户注册）
     * @return bool
     */
    public function register(array $info, array $data): bool
    {
        $data['merchant_id'] = $info['merchant_id'];
        $data['active_code'] = $info['active_code'];
        $data['create_time'] = time();
        $result = $this->create($data);
        if(!$result) return false;
        return true;
    }

    /**
     * 保存粉丝信息
     * @return bool
     */
    public function updateFansInfo(array $data): bool
    {
        $info = $this->findOne([
            'fans_account_code' => $data['fans_account_code'],
            'order_account_id' => $data['order_account_id'],
            'active_code' => $data['active_code'],
        ]);
        $info->fans_account_name = $data['fans_account_name'];
        $info->fans_flag = $data['fans_flag'];
        $info->remark = $data['remark'];
        $result = $info->save();
        if(!$result) return false;
        return true;
    }
}
