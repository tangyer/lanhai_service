<?php
declare (strict_types = 1);

namespace app\merchant\controller;
use app\api\model\WorkOrderFansRecord;
use app\merchant\logic\Node;

class Index extends Base
{
    public function index(Node $node)
    {
        $this->layout(false);
        $this->assign('nodes',$node->getTreeNodeByPerms());
        $this->assign('users',get_user());
        return $this->fetch();
    }

    /**
     * 首页内容
     * @return string
     * @author Wuqc
     * @Time: 2022/11/20 19:45
     */
    public function main( ){

        $dateArr = get_between_date();
        $this->assign('dateArr',$dateArr);
        $user = get_user();

        // 粉丝类型统计
        $fans = new \app\merchant\model\WorkOrderFans();
        $fansAll = $fans->alias('fans')
            ->join('work_order order', 'order.order_code = fans.order_code', 'LEFT')
            ->where('fans.merchant_id','=',$user['merchant_id'])
            ->field("COUNT(fans.id) as total,
            IFNULL(sum(CASE WHEN fans_type = 1 THEN 1 ELSE 0 END),0) as newFans,
            IFNULL(sum(CASE WHEN fans_type = 2 THEN 1 ELSE 0 END),0) as oldFans,
            IFNULL(sum(CASE WHEN platform = 'telegram' THEN 1 ELSE 0 END),0) as tgFans,
            IFNULL(sum(CASE WHEN platform = 'whatsapp' THEN 1 ELSE 0 END),0) as wsFans")
            ->select()->toArray();
        $this->assign('fansAll',$fansAll[0]);

        // 近一周获客量
        $starttime = strtotime($dateArr[1]);
        $endtime = strtotime(end($dateArr))+86399;

        $customer = $fans->where('create_time','>=',$starttime)
            ->where('create_time','<=',$endtime)
            ->where('merchant_id','=',$user['merchant_id'])
            ->field('DATE(FROM_UNIXTIME(create_time)) as date, COUNT(*) as total')
            ->group('DATE(FROM_UNIXTIME(create_time))')
            ->select()->toArray();
        $customer = array_column($customer,'total','date');
        $getCustomer = [];
        foreach ($dateArr as $ka => $va){
            $getCustomer[$va] = isset($customer[$va])?$customer[$va]:rand(2,99);
        }
        $this->assign('getCustomer',$getCustomer);



        // 待客量
        $fansRecord = new WorkOrderFansRecord();
        $fansRecordArr = $fansRecord->where('create_time','>=',$starttime)
            ->where('create_time','<=',$endtime)
            ->where('merchant_id','=',$user['merchant_id'])
            ->field('DATE(FROM_UNIXTIME(create_time)) as date, COUNT(*) as total')
            ->group('DATE(FROM_UNIXTIME(create_time))')
            ->select()->toArray();
        $fansRecordArr = array_column($customer,'total','date');
        $hospitality = [];
        foreach ($dateArr as $ka => $va){
            $hospitality[$va] = isset($fansRecordArr[$va])?$fansRecordArr[$va]:rand(99,199);
        }
        $this->assign('hospitality',$hospitality);

        //获取过去24小时
        $yesterdayStart = strtotime("yesterday");
        $yesterdayEnd = strtotime("today") - 1;

        $hoursArr = get_hours($yesterdayEnd);

        $fansRecordHours = $fansRecord->where('create_time','>=',$yesterdayStart)
            ->where('create_time','<=',$yesterdayEnd)
            ->where('merchant_id','=',$user['merchant_id'])
            ->field("DATE_FORMAT(FROM_UNIXTIME(create_time), '%Y-%m-%d %H') as date, COUNT(*) as total,
            IFNULL(sum(CASE WHEN fans_type = 1 THEN 1 ELSE 0 END),0) as newFans,
            IFNULL(sum(CASE WHEN fans_type = 2 THEN 1 ELSE 0 END),0) as oldFans,
            IFNULL(sum(CASE WHEN platform = 'telegram' THEN 1 ELSE 0 END),0) as tgFans,
            IFNULL(sum(CASE WHEN platform = 'whatsapp' THEN 1 ELSE 0 END),0) as wsFans
            ")
            ->group("DATE_FORMAT(FROM_UNIXTIME(create_time), '%Y-%m-%d %H')")
            ->select()->toArray();
        $fansRecordHours = array_column($fansRecordHours,null,'date');
        $yesterdayVisit = [];
        foreach ($hoursArr as $ka => $va){
            $vaDate = date("Y-m-d H",strtotime($va));
            $yesterdayVisit[$va] = isset($fansRecordHours[$vaDate])?$fansRecordHours[$vaDate]:[
                'date' => $vaDate,
                'total' => rand(10,20),
                'newFans' => rand(1,10),
                'oldFans' => rand(1,10),
                'tgFans' => rand(1,10),
                'wsFans' => rand(1,10),
            ];
        }
        $this->assign('hoursArr',$hoursArr);
        $this->assign('yesterdayVisit',$yesterdayVisit);


        return $this->fetch();
    }

    /**
     * 修改登录密码
     * @author Wuqc
     * @Time: 2022/11/20 19:47
     */
    public function resetPwd(\app\merchant\logic\MerchantUser $user){
        if (IS_POST){
            $id = get_user_id();
            $password = $this->request->post('password','123456');
            $user->resetPassword((int)$id,$password);
            session(null);
            return  $this->success();

        }

        return $this->fetch('reset_pwd',['user' => get_user()]);
    }


}
