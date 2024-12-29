<?php

namespace Util;

/**
 * 自定义加密解密
 * Class Encrypt
 * @package Util
 */
class Encrypt
{
    const SOURCE = 'E5FCDG3HQZ4B1NOPIJ2RSTUV67MWX89KLYA';
    const DIVIDER = '0';
    /**
     * 生成邀请码
     * @param int $num
     * @return string
     */
    public static function encode(int $num){
        $code = '';
        while ( $num > 0) {
            $mod = $num % 35;
            $num = ($num - $mod) / 35;
            $code = self::SOURCE[$mod].$code;
        }
        if(strlen($code) < 6){
            $code = str_pad($code,6,self::DIVIDER,STR_PAD_RIGHT);
        }
        return $code;
    }

    /**
     * 解码
     * @param $code
     * @return float|int
     */
    public static function decode($code) {
        if (strrpos($code, self::DIVIDER) !== false){
            $code = str_replace(self::DIVIDER,'',$code);
        }
        $len = strlen($code);
        $code = strrev($code);
        $num = 0;
        for ($i=0; $i < $len; $i++) {
            $num += strpos(self::SOURCE, $code[$i]) * pow(35, $i);
        }
        return $num;
    }


}

