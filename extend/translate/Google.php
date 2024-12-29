<?php

namespace translate;

use util\HttpClient;

class Google implements ITransEngine
{
    private  const URL = 'https://translate.googleapis.com/translate_a/single?client=gtx&dt=t';

    public function translate($text, $from, $to){
        $from = 'auto'; // 自动识别
        $url = self::URL.'&q='.$text.'&sl=auto&tl='.$to;
        $response = HttpClient::get($url);
        if ($response && is_array($response)){
            return  $response[0][0][0] ?? '';
        }
        return '';

    }
}