<?php

namespace app\common\provider;

use think\response\Json;

class Result
{
    const SUCCESS               = 1;
    const PARAM_ERROR           = 40001;    // 参数错误
    const VALIDATE_ERROR        = 40002;    // 数据验证错误
    const AUTH_ERROR            = 40003;    // 未开通相关权限
    const GATEWAY_ERROR         = 40004;    // 网关请求不存在
    const METHOD_ERROR          = 40005;    // 请求方式不允许
    const TOKEN_ERROR           = 40006;    // 身份验证错误
    const SIGN_ERROR            = 40007;    // 签名验证失败
    const DATA_NOT_ERROR        = 40008;    // 数据不存在
    const DATA_EXIST_ERROR      = 40009;    // 数据已存在
    const FAIL_ERROR            = 400010;    // 操作失败
    const SYS_ERROR             = 400011;    // 系统异常
    const TIMES_ERROR           = 400012;   // 次数限制错误
    const TIMEOUT_ERROR         = 400013;   // 超时错误
    const QUOTA_ERROR           = 400014;   // 限额错误
    const UNKNOWN_ERROR         = 400015;   // 其他错误


    public static function success(array $data = [], string $msg = 'success'): Json
    {
        return json([
            'code'  =>  self::SUCCESS,
            'msg'   =>  $msg,
            'data'  =>  $data
        ]);
    }

    /**
     * 失败返回
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return Json
     */
    public static function error(int $code,string $msg = 'fail',array  $data = []): Json
    {
        return json([
            'code'  =>  $code,
            'msg'   =>  $msg,
            'data'  =>  $data
        ]);
    }

}