<?php
declare (strict_types = 1);

namespace app\api\listener;

use app\api\model\Member;
use app\api\logic\MemberRecomLog;
use dh2y\qrcode\QRcode;

class MemberRegister
{
    /**
     * 用户注册事件监听处理
     * @param Member $member
     */
	public function handle(Member $member)
	{
	    // 添加邀请记录
        MemberRecomLog::addLog($member);

        // 生成邀请二维码
        $code = new QRcode();
        $url = request()->domain() . '/h5/index.html#/pages/login/register?inviteCode=' . $member->invite_code;
//        $res = $code->png($url,false, 6)->logo('./favicon.ico')->entry();
        $res = create_QR($url);
        $member->qrcode = $res;
        $member->save();
	}
}
