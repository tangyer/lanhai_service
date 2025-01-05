<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;
use think\facade\Db;
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
        $data['fans_type'] = 1;
        $data['create_time'] = time();

        $where = [
            'order_code' => $data['order_code'],
            'fans_account_id' => $data['fans_account_id'],
            'reset_status' => 0
        ];
        $whereSameAccount = [
            'order_account_id' => $data['order_account_id'],
        ];
        $workOrderFans = new \app\api\model\WorkOrderFans();
        // 当日 同主账号是否进过
        $todaySameAccountCount = $workOrderFans->where($where)->where($whereSameAccount)->whereDay('create_time')->count('id');
        if($todaySameAccountCount) return true;

        $updateData = [
            'fans_num' => Db::raw('fans_num + 1'), // 进粉总数
            'today_fans_num' => Db::raw('today_fans_num + 1'), // 当日进粉数
        ];
        // 同主账号是否进过
        $sameAccountCount = $workOrderFans->where($where)->where($whereSameAccount)->count('id');

        $sameOrderCount = false;
        // 当日工单是否进过
        $todaySameOrderCount = $workOrderFans->where($where)->whereDay('create_time')->count('id');
        // 当日工单进过 当日重粉 +1
        if($todaySameOrderCount){
            // 当日重复粉数 +1
            $updateData['today_fans_repeat_num'] = Db::raw('today_fans_repeat_num + 1');
        }else{
            // 同工单是否进过
            $sameOrderCount = $workOrderFans->where($where)->count('id');
        }
        // 同主账号进过 或 当日工单进过 或 工单进过
        if ($sameAccountCount || $todaySameOrderCount || $sameOrderCount){
            // 同工单进过标记为老粉
            $data['fans_type'] = 2;
            // 重复粉数 +1
            $updateData['fans_repeat_num'] = Db::raw('fans_repeat_num + 1');
        }

        try {
            // 开始事务
            Db::startTrans();
            // 更新主账号统计
            (new \app\api\model\WorkOrderAccount())->where('account_id',$data['order_account_id'])->update($updateData);
            // 更新工单统计
            (new \app\api\model\WorkOrder())->where('order_code',$data['order_code'])->update($updateData);
            // 添加粉丝信息
            $result = $workOrderFans->create($data);
            if(!$result) return false;
            // 添加粉丝记录
            (new \app\api\logic\WorkOrderFansRecord())->create([
                'merchant_id' => $data['merchant_id'],
                'order_code' => $data['order_code'],
                'order_account_id' => $data['order_account_id'],
                'order_fans_id' => $result->id,
                'fans_type' => $data['fans_type'],
                'create_time' => $data['create_time']
            ]);

            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return false;
        }
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
