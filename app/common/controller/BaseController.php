<?php
declare (strict_types = 1);

namespace app\common\controller;

use app\common\provider\Result;
use think\App;
use think\Request;
use think\facade\View;
use think\response\Json;

/**
 * 控制器基础类
 */
abstract class BaseController
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
        $this->initRequestConst();
        // 控制器初始化
        $this->init();


    }

    // 初始化
    protected function init(){

    }

    // 初始化请求信息
    protected function initRequestConst(){
        defined('IS_POST')  or define('IS_POST', $this->request->isPost());
        defined('IS_GET')   or define('IS_GET',  $this->request->isGet());
        defined('IS_AJAX')  or define('IS_AJAX', $this->request->isAjax());
    }



    /**
     * 页面渲染
     * @param string $template  页面
     * @param array $data 数据
     * @return string
     */
    protected function fetch(string $template = '', array $data = []): string
    {
        return View::fetch($template,$data);
    }

    /**
     *模板赋值
     * @param string|array $name
     * @param $value
     */
    protected function assign($name,$value = null ){
        View::assign($name,$value);
    }

    /**
     * 设置布局开关
     * @param bool $bool
     */
    protected function layout(bool $bool = true){
        View::engine()->layout($bool);
    }

    /**
     * 成功响应
     * @param array $data
     * @param string $message
     * @return Json
     */

    protected function success(array $data = [],string $message = '成功'): Json
    {
        $result = Result::success($data,$message);

        return IS_POST ? $result->header([
            '__token__' => token()
        ]) : $result;
    }

    /**
     * 错误响应
     * @param int $code
     * @param string $message
     * @param array $data
     * @return Json
     */
    protected function error(int $code,string $message = 'fail',array $data = []): Json
    {
        $result = Result::error($code,$message,$data);

        return IS_POST ? $result->header([
            '__token__' => token()
        ]) : $result;
    }


}
