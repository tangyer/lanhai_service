<?php
declare (strict_types = 1);

namespace app\api\logic;
use app\common\logic\BaseLogic;
use think\facade\Db;

class SessionRecords extends BaseLogic
{
    /**
     * @param array $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function createSession(array $data)
    {
        // 查重
        $repeat = $this->model->where(['sessionId'=>$data['sessionId']])->count();
        if($repeat>0){
            return ['status'=>0,'msg'=>'会话ID已存在'];
        }
        // 查询token相关工单
        $order = (new \app\admin\model\WorkOrder())->where(['platform'=>$data['platform'],'active_code'=>$data['active_code']])
            ->find();

        // 存库
        $insert = [
            'sessionId'=>$data['sessionId'],
            'platform'=>$data['platform'],
            'active_code'=>$order->active_code,
            'order_code' =>$order->order_code,
            'create_time'=>time()
        ];
        // 创建会话  占用端口
        $order->port_use_num += 1;
        //$order->port_online_num += 1;

        Db::startTrans();
        try {
            $this->model->insert($insert);
            $order->save();
            // 提交事务
            Db::commit();

            return ['status'=>1,'msg'=>'success'];
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 处理异常
            return ['status'=>0,'msg'=>$e->getMessage()];
        }
    }

    /**
     * @param array $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 删除会话
     */
    public function deleteSession(array $data)
    {
        return $this->deleteSessionBySessionId($data['sessionId']);
    }

    public function deleteSessionBySessionId(string $sessionId)
    {
        // 查询会话
        $session = $this->model->findOne(['sessionId'=>$sessionId]);

        // 查询token相关工单
        $order = (new \app\admin\model\WorkOrder())
            ->where(['order_code'=>$session->order_code])
            ->find();


        //查询相关用户
        $accountMo = (new \app\api\model\WorkOrderAccount());
        $order_account_id = 0;
        if(!empty($session->account_id)){
            // 查询用户是否是多会话登录
            $sessionNum = $this->model->where('order_account_id',$session->order_account_id)
                ->count();
            if($sessionNum == 1){
                $account = $accountMo->where(['id'=>$session->order_account_id])
                    ->find();
                $order_account_id = $account->order_account_id ?? 0;
                // 删除会话  账号下线
                $account->online_status = 0;
                $account->port_status = 0;
                $account->offline_time = time();
            }
        }

        // 删除会话解除端口
        $order->port_use_num = $order->port_use_num > 0 ? $order->port_use_num -1 : 0;
        if(!empty($order_account_id)){
            $order->port_online_num = $order->port_online_num > 0 ? $order->port_online_num -1 : 0;
        }

        Db::startTrans();
        try {
            //删除会话
            $session->delete();
            //释放端口
            $order->save();
            //下线账号
            if(!empty($order_account_id)){
                $account->save();
            }

            // 提交事务
            Db::commit();

            return ['status'=>1,'msg'=>'success'];
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            // 处理异常
            return ['status'=>0,'msg'=>$e->getMessage()];
        }
    }
}
