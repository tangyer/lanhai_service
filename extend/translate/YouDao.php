<?php

namespace translate;

use util\HttpClient;

class YouDao implements ITransEngine
{
    private  const URL = 'https://openapi.youdao.com/api';

    public function translate($text, $from, $to){
        $from = 'auto'; // 自动识别

        $appId = '7ce01e37da08faa0';

        $secret = 'gAwAu8Nt7Y7j25JeJUazpheK1G4XhT7l';

        $salt = generate_rand_str();

        $time = time();

        $len = mb_strlen($text, 'utf-8');

        $input =  $len <= 20 ? $text : (mb_substr($text, 0, 10) . $len . mb_substr($text, $len - 10, $len));

        $sign = hash('sha256', $appId.$input.$salt.$time.$secret);

        return HttpClient::post(self::URL,[
            'q' => $text,
            'from' => $from,
            'to' => $to,
            'appKey'=> $secret,
            'salt' => $salt,
            'sign' => $sign,
            'signType' => 'v3',
            'curtime' => $time
        ]);

    }
}