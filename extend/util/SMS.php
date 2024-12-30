<?php

namespace util;

use app\common\provider\CacheName;
use think\exception\ValidateException;
use think\facade\Cache;
use think\facade\Log;

/**
 * 短信
 * @
 */
class SMS
{
    const URL = 'http://api.wftqm.com/api/sms/mtsend';
    const APP_KEY = 'UBFfGYsX';
    const APP_SECRET = 'AH8rYjyG';

    /**
     * 发送验证码
     * @param string $country
     * @param string $mobile
     * @return bool
     * @throws \Exception
     */
    public static function send(string $mobile, string $country = ''){

        if (!$mobile || !$country){
            throw new ValidateException('mobile_country_require');
        }

        $code = random_int(1000,9999);
        $result = HttpClient::post(self::URL,[
            'appkey' => self::APP_KEY,
            'secretkey' => self::APP_SECRET,
            'phone' => $country.$mobile,
            'content'  => urlencode(env("app_name").': your verify code is '.$code)
        ]);
        Log::write($result);
        if ($result && $result['code'] === '0'){
            Cache::set(CacheName::PREFIX.$mobile,(string)$code,900);
            return true;
        }
        return false;
    }

    /**
     * 检查验证码
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public static function checkCode(string $mobile,string $code): bool
    {
        $verifyCode =  Cache::get(CacheName::PREFIX.$mobile);
        if ($code === $verifyCode){
            Cache::delete(CacheName::PREFIX.$mobile);
            return true;
        }
        return false;
    }
}