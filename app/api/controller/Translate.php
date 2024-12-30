<?php

namespace app\api\controller;

use app\common\controller\BaseController;
use think\response\Json;

class Translate extends BaseController
{
    /**
     * 获取所有翻译引擎
     * @return Json
     */
    public function getAllEngine(): Json
    {
        return $this->success([
            ['id' => 1,'engine_code' => 'google','engine' => '谷歌'],
            ['id' => 2,'engine_code' => 'baidu','engine' => '百度'],
            ['id' => 3,'engine_code' => 'youdao','engine' => '有道']
        ]);
    }

    public function getAllLang($engineCode): Json
    {
        $data = [
            [
                'id' => 1,
                'engine_code' => 'google',
                'lang_code' => 'zh',
                'lang_name' => '中文',
            ],
            [
                'id' => 2,
                'engine_code' => 'google',
                'lang_code' => 'en',
                'lang_name' => '英文',
            ],
            [
                'id' => 3,
                'engine_code' => 'baidu',
                'lang_code' => 'en',
                'lang_name' => '英文',
            ],
            [
                'id' => 4,
                'engine_code' => 'baidu',
                'lang_code' => 'zh',
                'lang_name' => '中文',
            ]
        ];
        return $this->success();
    }
}