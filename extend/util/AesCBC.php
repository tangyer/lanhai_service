<?php
namespace util;

class AesCBC{

    const KEY = '84bfd6ad238c1a031e48b269901cb6b3';

    const IV  = 't873kh0jf8dh3oaf';

    const CIPHER = 'AES-256-CBC';

    /**
     * 加密
     * @param String $str 加密字符串
     * @param Bool $hex 是否转二进制
     * @return String
     */
    public static function encrypt(string $str = '', bool $hex = false): string
    {
        $mc = openssl_encrypt($str,self::CIPHER,self::KEY ,OPENSSL_RAW_DATA,self::IV);
        
        return $hex ? self::strToHex($mc) : base64_encode($mc);
    }

    /**
     * 解密
     * @param String $str 解密字符串
     * @param Bool $hex 是否二进制转换
     * @return String
     */
    public static function decrypt(string $str, bool $hex=false): string
    {
        if($hex){
            $str = self::hexToStr($str);
        }else{
            $str = base64_decode($str);
        }
        return openssl_decrypt($str,self::CIPHER,self::KEY,OPENSSL_RAW_DATA,self::IV);
    }


    /**
     * 十六进制转字符串
     * @param $hex
     * @return String
     */
    private static function  hexToStr($hex): string
    {
        $string="";
        for($i=0;$i<strlen($hex)-1;$i+=2)
            $string.=chr(hexdec($hex[$i].$hex[$i+1]));
        return  $string;
    }

    /**
     * 字符串转十六进制
     * @param $string
     * @return String
     */
    private static function strToHex($string): string
    {
        $hex = $tmp = "";
        for($i=0;$i<strlen($string);$i++)
        {
            $tmp = dechex(ord($string[$i]));
            $hex.= strlen($tmp) == 1 ? "0".$tmp : $tmp;
        }
        $hex=strtoupper($hex);
        return $hex;
    }


}

