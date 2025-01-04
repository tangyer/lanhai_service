<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\controller\BaseController;
use app\common\provider\Result;
use app\common\traits\ApiAction;
use app\merchant\model\WorkOrderBranch;
use think\facade\Cache;

class Share extends BaseController
{
    public function shunt(\app\api\logic\WorkOrder $workOrder,\app\api\logic\WorkOrderAccount $workAccount)
    {
        // 获取连接中的工单号
        $url = $_SERVER['REQUEST_URI'];
        $urlArr = explode('/', $url);
        $orderCode = array_pop($urlArr);
        // 查询工单是否存在
        $order = $workOrder->findOne(['order_code' => $orderCode],false);
        if(empty($order)){
            return $this->error(Result::PARAM_ERROR,'Error');
        }
        // 获取工单下的账号
        $accountAll = $workAccount->getAll(['order_code' => $orderCode,'online_status'=>1,'port_status'=>0])->toArray();
        if(empty($accountAll)){
            return $this->error(Result::PARAM_ERROR,'Error');
        }
        // 获取当前访问总量
        $key = 'Shunt_'.$orderCode;
        $currentIndex= Cache::get($key);
        if($currentIndex === null) {
            $currentIndex = 0;
        }
        // 获取轮询账号
        $account = $accountAll[$currentIndex]?? ($accountAll[0] ?? []);

        // 存入缓存
        $nextIndex=($currentIndex+1)% count($accountAll);
        Cache::set($key,$nextIndex);

        // 记录点击数
        $branch = new WorkOrderBranch();
        $branch->where('order_code',$orderCode)->setInc('click_num',1);

        // 更新工单进粉
//        $order->fans_num += 1;
//        $order->fans_repeat_num += 0;
//        $order->today_fans_num += 1;
//        $order->save();

        // 记录当前账号粉丝数
//        $account['fans_num'] += 1;
//        $account['today_fans_repeat_num'] += 1;
//        $account['fans_repeat_num'] += 1;
//        $account['today_fans_num'] += 1;
//        $workAccount->update($account);

        //跳转连接
        return redirect($account['account_link']);
    }
}

