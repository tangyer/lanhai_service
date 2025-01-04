<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\provider\Result;
use app\common\traits\Action;
use think\response\Json;
use translate\Baidu;
use translate\Google;
use translate\ITransEngine;
use translate\YouDao;

class TranslateEngine extends Base
{
//    public function index(\app\api\logic\TranslateEngine $engine){
//        return $this->success($engine->getAll($this->request->param())->toArray());
//    }

    /**
     * 获取所有翻译引擎
     * @return Json
     */
    public function getAllEngine(): Json
    {
        return $this->success([
            ['id' => 1,'engine_code' => 'google','engine_type' => 'general','engine' => '谷歌'],
            ['id' => 2,'engine_code' => 'baidu','engine_type' => 'general','engine' => '百度'],
            ['id' => 3,'engine_code' => 'youdao','engine_type' => 'general','engine' => '有道'],
            ['id' => 4,'engine_code' => 'openai','engine_type' => 'profession','engine' => 'openai'],
            ['id' => 5,'engine_code' => 'doubao','engine_type' => 'profession','engine' => '豆包'],
        ]);
    }


    public function getAllLang(): Json
    {
        $data = [
            [
                'lang_code' => 'en',
                'lang_name' => '英文',
            ],
            [
                'lang_code' => 'de',
                'lang_name' => '德语',
            ],
            [
                'lang_code' => 'zh',
                'lang_name' => '中文',
            ]];
        return $this->success($data);
    }

    public function translate(): Json
    {
        $time_start = microtime(true);
        $params = $this->getInput();
        $engineCode = $params['engineCode'] ?? 'google';
        $fromLang = $params['fromLang'] ?? '';
        $toLang = $params['toLang'] ?? '';
        $text = $params['text'] ?? '';
        if (!$engineCode || !$fromLang || !$toLang || !$text) {
            return $this->error(Result::PARAM_ERROR,'参数错误');
        }

        $engine = $this->getEngine($engineCode);
        $result = $engine->translate($text,$fromLang,$toLang);
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        trace('运行时间', $time .'=================================');
        return $this->success(['result' => $result]);
    }

    public function getEngine($engineCode) : ITransEngine
    {
        if ($engineCode == 'google'){
            return new Google();
        }
        if ($engineCode == 'youdao'){
            return new YouDao();
        }
//        默认百度
        return new Baidu();
    }

}
