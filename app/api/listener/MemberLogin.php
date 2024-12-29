<?php
declare (strict_types = 1);

namespace app\api\listener;

use app\api\model\Member;
use GeoIp2\Database\Reader;

class MemberLogin
{
    /**
     * 用户登录事件监听处理
     * @param Member $member
     */
	public function handle(Member $member)
	{
		$member->last_login_time = time();
		$member->fail_times = 0;
		$member->last_login_ip = request()->ip();

        // $reader = (new Reader('geodb/GeoLite2-City.mmdb'));
        // $record = $reader->city($member->last_login_ip);
        // $cityName = $record->country->names;
		// $member->last_login_city = $cityName['zh-CN'] ?? '';
		$member->save();
	}
}
