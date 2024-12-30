<?php

namespace util;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use think\facade\Log;

class HttpClient
{
    static protected  $instance;

    /**
     * get 请求
     * @param string $url
     * @param array $params
     * @return array|mixed
     * @throws GuzzleException
     * @author Sugar
     * @Time: 2022/10/21 15:41
     */
    public static function get(string $url = '',array $params = []): mixed
    {
        $client = self::getClient();
//        $option = [];
        //开启代理
        $option = [
            'proxy' => 'http://127.0.0.1:7890',
        ];
        if ($params){
            $option['query'] = $params;
        }
        try {
            $response = $client->get($url,$option);
            return json_decode((string)$response->getBody(),true);

        }catch (RequestException  $exception){
            return [];
        }
    }

    /**
     * post 请求
     * @param string $url
     * @param array $params
     * @return array|mixed
     * @throws GuzzleException
     * @author Sugar
     * @Time: 2022/10/21 15:43
     */
    public static function post(string $url = '',array $params = []){
        try {
            $response = self::getClient()->post($url,[
                'form_params' => $params
            ]);
            return json_decode((string)$response->getBody(),true);

        }catch (RequestException  $exception){
            Log::error($exception->getMessage());
            return [];
        }
    }

    private static function getClient(): Client
    {
        if (!self::$instance instanceof Client) {
            self::$instance = new Client(['verify' => false]);
        }
        return self::$instance;
    }



}