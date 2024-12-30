<?php
namespace app\api\provider;

use app\common\provider\Result;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\InvalidArgumentException;
use think\exception\ValidateException;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * API应用 错误返回JSON，无需返回
     * @var array
     */
    protected array $apiName = [

    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     * API 应用需修正 : 全部返回JSON 并且 无需响应TOKEN
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        $code = Result::UNKNOWN_ERROR;

        if ($e instanceof HttpException) {
            if ($e->getStatusCode() == 500) {
                //500 错误记录 记录日志,发送邮件
                return Result::error(Result::SYS_ERROR,'system_error');
            }
            if ($e->getStatusCode() == 404) {
                return Result::error(Result::GATEWAY_ERROR,'gateway_error'.$e->getMessage());
            }

            $code = $e->getStatusCode();
        }

        if ($e instanceof ValidateException) {
            $code = Result::VALIDATE_ERROR;
        }
        if ($e instanceof DataNotFoundException) {
            $code = Result::DATA_NOT_ERROR;
        }
        if ($e instanceof InvalidArgumentException){
            $code = Result::PARAM_ERROR;
        }
        return Result::error($code,$e->getMessage());
    }
}
