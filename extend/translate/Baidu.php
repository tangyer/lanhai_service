<?php

namespace translate;

use util\HttpClient;

class Baidu implements ITransEngine
{
    private  const URL = 'https://fanyi-api.baidu.com/api/trans/vip/translate/';

    public function translate($text, $from, $to){

//        $appId = '20221014001393040';

//        $secret = '0Fbx5GBhVpbSlNPFoErE'; 已欠费

        $from = 'auto'; // 自动识别

        $appId = '20241218002231642';

        $secret = 'lDDYOv_2JRe4zW_uAMod';

        $salt = generate_rand_str();

        $sign = md5($appId . $text . $salt . $secret);

        $url = self::URL.'?q='.$text.'&from='.$from.'&to='.$to.'&appid='.$appId.'&salt='.$salt.'&sign='.$sign;

        $response = HttpClient::get($url);

        return $response['trans_result'][0]['dst'] ?? '';

    }
}