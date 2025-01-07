<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;
use think\Exception;
use think\facade\Db;

class WorkOrderAccount extends BaseLogic
{
    /**
     * 添加主账号信息
     * @return Bool
     */
    public function addMainAccount(array $params, string $sessionId): bool
    {
        $params['online_status'] = 1;
        $params['port_status'] = 1;
        $params['online_time'] = time();
        $params['create_time'] = time();
        $id = $this->getFieldValue(['order_code' => $params['order_code'], 'account_id' => $params['account_id']], 'id');

        try {
            // 开始事务
            Db::startTrans();
            if($id){
                // 存在 更新
                $result = $this->update([
                    'id' => $id,
                    'online_status' => $params['online_status'],
                    'port_status' => $params['port_status'],
                    'online_time' => $params['online_time'],
                    'token' => $params['token']
                ]);
            }else{
                // 不存在 新增
                $result = (new \app\api\model\WorkOrder())->create($params);
                $id = $result->id;
            }

            // 更新会话信息
            (new \app\api\model\SessionRecords())->where('sessionId', $sessionId)->update([
                'order_account_id' => $id,
                'account_id' => $params['account_id'],
                'token' => $params['token']
            ]);
            if(!$result) return false;

        }catch (\Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
        }
        return true;
    }

    /**
     * 批量下线
     * @return Bool
     */
    public function updateBatchOffline(array $params): bool
    {
        $data = [
            'online_status' => $params['online_status'],
            'port_status' => 0,
            'offline_time' => $params['offline_time'],
            'token' => ''
        ];
        $workOrderData = (new \app\api\model\WorkOrderAccount())->field('order_code,count(id) as number')
            ->where([
                'active_code' => $params['active_code'],
                'token' => $params['token']
            ])
            ->group('order_code')
            ->select();

        $result = (new \app\api\model\WorkOrderAccount())
            ->where([
                'active_code' => $params['active_code'],
                'token' => $params['token']
            ])
            ->update($data);
        if(!$result) return false;

        foreach ($workOrderData as $key => $item){
            (new \app\api\model\WorkOrder)->where('order_code', $item->order_code)
                ->dec('port_use_num', $item->number)
                ->dec('port_online_num', $item->number)
                ->update();
        }
        return true;
    }

    /**
     * 更新上线时间以及登录状态
     * @return Bool
     */
    public function updateMainAccount(array $params, string $sessionId): bool
    {
        // 根据会话id 查询关联主账号
        $sessionInfo = (new SessionRecords())->findOne(['sessionId' => $sessionId]);
        $info = $this->findOneById($sessionInfo->order_account_id);
        $info->online_status = $params['online_status'];
        $info->online_time = !empty($params['last_login_time']) ? $params['last_login_time'] : $params['login_time'];
        $info->port_status = $params['port_status'];
        try {
            // 开始事务
            Db::startTrans();
            $result = $info->save();
            if(!$result) return false;
            // 在线端口 +1
            if($params['online_status'] == 1){
                (new \app\api\model\WorkOrder())->inc('port_online_num', 1)->update();
            }else{
                // 在线端口 -1
                (new \app\api\model\WorkOrder())->dec('port_online_num', 1)->update();
            }
        }catch (\Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
        }

        return true;
    }
}
