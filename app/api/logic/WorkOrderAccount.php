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
                $result = (new \app\api\model\WorkOrderAccount())->create($params);
                $id = $result->id;
            }

            // 更新会话信息
            (new \app\api\model\SessionRecords())->where('sessionId', $sessionId)->update([
                'order_account_id' => $id,
                'account_id' => $params['account_id'],
                'token' => $params['token']
            ]);
            if(!$result) return false;
            //在线端口 +1
            (new \app\api\model\WorkOrder())->where('order_code',$params['order_code'])
                ->inc('port_online_num', 1)
                ->update();

            // 提交事务
            Db::commit();
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
            'online_status' => 0,
            'port_status' => 0,
            'offline_time' => time(),
            'token' => ''
        ];

        // 根据会话Id 查询主账号id
        $orderAccountId = (new \app\api\model\SessionRecords())
            ->whereIn('sessionId',$params['sessionId'])
            ->column('order_account_id');

        if (!$orderAccountId) return true;
        try {
            // 开始事务
            Db::startTrans();

            $workOrderAccountData = (new \app\api\model\WorkOrderAccount())->field('order_code,count(id) number')
                ->whereIn('id',$orderAccountId)
                ->group('order_code')->select();

            // 修改主账号登录状态
            $result = (new \app\api\model\WorkOrderAccount())
                ->whereIn('id',$orderAccountId)
                ->update($data);

            if(!$result) return false;
            
            foreach($workOrderAccountData as $item){
                // 在线端口 减掉
                (new \app\api\model\WorkOrder)->where('order_code', $item->order_code)
                    ->dec('port_online_num', $item->number)
                    ->update();
            }

            // 提交事务
            Db::commit();
        }catch (\Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
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
        $sessionInfo = (new \app\api\model\SessionRecords())->where(['sessionId' => $sessionId])->find();
        if(empty($sessionInfo) || empty($sessionInfo['order_account_id'])){
            return true;
        }
        try {
            // 开始事务
            Db::startTrans();
            $info = $this->findOneById($sessionInfo['order_account_id']);
            // 离线状态时上线 在线端口 +1
            if($params['online_status'] == 1 && $info->online_status == 0){
                (new \app\api\model\WorkOrder())->where('order_code',$sessionInfo['order_code'])
                    ->inc('port_online_num', 1)
                    ->update();
            }elseif($params['online_status'] == 0 && $info->online_status == 1){
                // 在线状态时离线 在线端口 -1
                (new \app\api\model\WorkOrder())->where('order_code',$sessionInfo['order_code'])
                    ->dec('port_online_num', 1)
                    ->update();
            }
            $info->online_status = $params['online_status'];
            $info->online_time = !empty($params['last_login_time']) ? $params['last_login_time'] : $params['login_time'];
            $info->port_status = $params['port_status'];
            if($params['online_status'] == 0){
                $info->offline_time = time();
            }
            $result = $info->save();
            if(!$result) return false;
            // 提交事务
            Db::commit();
        }catch (\Exception $e){
            // 回滚事务
            Db::rollback();
            return false;
        }

        return true;
    }
}
