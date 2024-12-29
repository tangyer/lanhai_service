<?php

namespace app\api\controller;

use app\common\provider\Result;
use think\App;
use think\Request;
use think\response\Json;

abstract class Base
{
	/**
	 * Request实例
	 * @var Request
	 */
	protected Request $request;

	/**
	 * 应用实例
	 * @var App
	 */
	protected App $app;

	/**
	 * 构造方法
	 * @access public
	 * @param  App  $app  应用对象
	 */
	public function __construct(App $app)
	{
		$this->app     = $app;
		$this->request = $this->app->request;
		// 控制器初始化
		$this->init();
	}

	// 初始化
	protected function init(){

	}

    /**
     * 获取请求body
     * @return array|string
     * @author Sugar
     * @Time: 2022/10/21 17:05
     */
    protected function getInput($key = ''): array|string
    {
        $params = $this->request->getInput();
        if ($params){
            $body = json_decode($params,true);
            if ($key){
                return $body[$key];
            }
            return $body;
        }
        return [];
//        throw new InvalidArgumentException('参数错误');
    }

	/**
	 * 成功响应
	 * @param array $data
	 * @param string $message
	 * @return Json
	 */
	protected function success(array $data = [],string $message = 'success'): Json
	{
		return Result::success($data,$message);
	}

	/**
	 * 错误响应
	 * @param int $code
	 * @param string $message
	 * @param array $data
	 * @return Json
	 */
	protected function error(int $code,string $message,array $data = []): Json
	{
		return Result::error($code,$message,$data);
	}
}