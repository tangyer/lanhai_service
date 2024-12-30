<?php
declare (strict_types = 1);

namespace app\api\controller;

use app\api\logic\MemberLevel;
use app\api\model\SystemNotice;
use app\common\model\Comment;
use app\common\model\ProductComment;
use app\common\provider\pay\bank\QePay\BRL;
use app\api\logic\Banner;
use app\api\logic\Member;
use app\api\logic\ProductConfig;
use app\common\provider\Request;
use app\api\logic\CustomerService;
use app\api\logic\Pages;
use think\response\Json;
use app\api\logic\Notice;
use app\common\provider\Result;


class Index extends Base
{

    protected array $middleware = [
        'auth' => ['except' => ['productConfigList','comInfo', 'getPages', 'qrcode', 'getCustomerService', 'getLevel', 'getComment','upload']],
    ];

    public function productConfigList()
    {
        return $this->success((new ProductConfig())->getAll());
    }


    public function getPayQRCode()
    {
        $pay = config('hr.pay');
        foreach ($pay as $key => $value) {
            $pay[$key]['qrCode'] = request()->domain() . $value['qrCode'];
        }
        return $this->success($pay);
    }


    /**
     * 获取评论
     * @return Json
     */
    public function getComment()
    {
        return $this->success((new Comment())->getAll()->toArray());
    }

    /**
     * 获取等级
     * @return Json
     */
    public function getLevel()
    {
        return $this->success((new MemberLevel())->getAll()->each(function ($item) {
            $item->content = html_entity_decode($item['content']);
            $item->icon = $item->icon ? request()->domain() . $item->icon : '';
        })->toArray());
    }

    /**
     * 获取系统消息
     * @return Json
     */
    public function getSystemNotice()
    {
        $where['kind'] = $this->request->param('kind');
        $where['member_id'] = $this->request->member->id;
        return $this->success((new SystemNotice())->getAll($where)->toArray());
    }

    /**
     * 设置已读
     * @return Json
     */
    public function setRead()
    {
        (new \app\api\logic\SystemNotice())->setRead([
            'id' => $this->request->post('id/d', 0),
            'member_id' => $this->request->member->id
        ]);
        return $this->success();
    }


    public function index2(Request $request, Banner $banner, Notice $notice)
    {

//        $data['banner'] = $banner->getBanner(['pos'=>'index_top']);//获取轮播图
        $data['scrollingData'] = $this->getScrollingData(); // 假数据
        $data['notice'] = $notice->getAll()->each(function ($item){
            $item->content = $item->content  ? html_entity_decode($item->content) : '';
        }); // 系统公告
		return $this->success($data);
    }

    public function getProductComment()
    {
        $param = $this->request->param();
        return $this->success((new ProductComment())->getList($param)->toArray());
    }

    private function getScrollingData(){

        $str = 'Aar***_Anth***_Ar***_Au***_Bi***l_Bri***_Bru***_Car***_Chri****_Col***_Den***_Don****_Edg***_Edw***d_Ed***n_Fr***cis_Ga***iel_G***by_Gar***ld_Ga***ry';
        $notices = [];
        //获取首页滚动数据
        $yesDay = date('Y-m-d', strtotime('-1 day'));
        $endTime = strtotime($yesDay.' 22:00:00');
        $lastTime = (time() > $endTime ? $endTime : time()) - 1000;
        $addressNames = explode("_", $str);
//        $minPrice = (int)get_config('index_min_price') * 100;
//        $maxPrice = (int)get_config('index_max_price') * 100;

        $minPrice = 10;
        $maxPrice = 15000;
        for ($i=0; $i < 10; $i++) {
            $lastTime += rand(30, 100);
            $notices[] = [
                'id' => 0,
                'avatar' => request()->domain()."/uploads/avatar/".rand(1,16).".jpg",
                'money' => random_int($minPrice, $maxPrice) / 100,
                'nickname' => $addressNames[rand(0, count($addressNames) - 1)],
                'user_id' => 0,
                'create_time' => date('d-m-Y H:i:s', $lastTime)
            ];
        }

        return $notices;

    }

    /**
     * 获取客服列表
     * @param CustomerService $customerService
     * @return Json
     * @author Sugar
     * @Time: 2022/11/2 16:12
     */
    public function getCustomerService(CustomerService $customerService): Json
    {
//        return $this->success($customerService->getNewLink());
        return $this->success($customerService->getAll());
    }

    /**
     * 获取一条信息
     * @param Pages $pages
     * @return Json
     */
    public function getPages(Pages $pages){

        $where['kind'] = $this->request->param('kind');
        $where['status'] = 1;

        if($where['kind'] == 3){
            $pagesinfo=$pages->getAll($where);
            $pagesinfo = $pagesinfo->each(function ($item){
                $item->content = html_entity_decode($item->content);
            })->toArray();
        }else {
            $pagesinfo = $pages->findOne($where, false);
            if($pagesinfo){
                $pagesinfo = $pagesinfo->toArray();
                $pagesinfo['content'] = html_entity_decode($pagesinfo['content']);
            }else{
                $pagesinfo = [];
            }
        }
        return $this->success($pagesinfo);
    }

    /**
     * 修改访问密码
     * @param Member $member
     * @return Json
     */
    public function changePassword(Member $member){

        $param = $this->request->param();
        $param['id'] = $this->request->member->id;
        $res = $member->changePassword($param);
        return $this->success([],lang('change.success'));
    }

    /**
     * 验证资金密码
     */
    public function validateTradePassword(Member $member)
    {
        $param = $this->request->param();
        $param['id'] = $this->request->member->id;
        return $this->success([$member->validateTradePassword($param)]);


    }

    /**
     * 修改交易密码
     * @param Member $member
     * @return Json
     */
    public function changeTradePassword(Member $member){

        $param = $this->request->param();
        $param['id'] = $this->request->member->id;
        $res = $member->changeTradePassword($param);
        return $this->success([],lang('change.success'));

    }

    /**
     * 设置交易密码
     * @param Member $member
     * @return Json
     */
    public function setTradePassword(Member $member){
        $param = $this->request->param();
        $param['id'] = $this->request->member->id;
        $res = $member->setTradePassword($param);
        return $this->success([],lang('change.success'));

    }

    /**
     * 邀请二维码信息
     * @param Member $member
     * @return Json
     */
    public function getQrcode(Member $member)
    {
        $param['invite_code'] = $this->request->member->invite_code;
        $recomData = $member->getQrcode($param);
        return $this->success($recomData);
    }


    /**
     * 生成邀请二维码
     * @param Member $member
     * @return mixed
     */
    //生成邀请二维码
    public function invitation(Member $member)
    {
        $param['invite_code']=$this->request->member->invite_code;
        return  $member->invitation($param);
    }



    /**
     * 公共设置信息
     * @return Json
     */
    public function comInfo()
    {
        $comInfo['withdrawal_rate'] = get_config('withdrawal_rate'); //提现手续费
        $comInfo['withdrawal_min']  = get_config('withdrawal_min'); //提现最小限制
        $comInfo['recharge_min']    = get_config('recharge_min'); // 充值最小限制
        $comInfo['usdt_link']    = get_config('usdt_link'); // usdt充值地址
        $comInfo['index_level_rate']    = explode(',',get_config('index_level_rate')); // 首页展示会员比率
        return $this->success($comInfo);
    }

    /**
     * 修改头像
     * @return Json
     * @author Wuqc
     * @Time: 2022/12/3 20:56
     */
    public function setUserIcon()
    {
        $id = $this->request->post('id/d');
        $member = $this->request->member;
        $icon = "/uploads/avatar/".$id.".png";
        $member->icon = $icon;
        $member->save();
        return $this->success();
    }

    /**
     * 修改昵称
     * @return Json
     * @author Wuqc
     * @Time: 2022/12/3 22:23
     */
    public function setUserNickname()
    {
        $nickname = $this->request->post('nickname');
        $member = $this->request->member;
        $member->nickname = $nickname;
        $member->save();
        return $this->success();
    }

    /**
     * 获取银行卡列表
     * @return Json
     * @author Wuqc
     * @Time: 2022/12/3 21:48
     */
    public function getBankList()
    {
        // 获取银行卡列表根据对接的通道文档中的银行卡来定制
        $bankList = BRL::$bankList;
        return $this->success($bankList);
    }

    /**
     * 上传
     * @return Json
     */
    public function upload()
    {
        // 获取表单上传文件
        $file = request()->file('file');
        validate(['file'=> 'fileSize:10240000|fileExt:jpg,png,jpeg,gif'])->check(['file' => $file]);
        $res = \think\facade\Filesystem::putFile( '', $file);
        $res = '/uploads/'.str_replace('\\','/',$res);
        return  $this->success(['path' => $res, 'show_path' => request()->domain() . $res],lang('upload_success'));
    }

    /**
     * 生成邀请二维码
     * @param Member $member
     * @return mixed
     */
    //生成邀请二维码
    public function qrcode(Request $request)
    {
        $params = $this->request->param();
        $params['isShow'] = 1;
        return (new \util\Qrcode())->create($params);
    }
}
