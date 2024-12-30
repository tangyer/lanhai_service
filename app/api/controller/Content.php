<?php

namespace app\api\controller;

use app\common\controller\BaseController;
use think\response\Json;

class Content extends BaseController
{
    /**
     * 获取语言
     * @return Json
     */
    public function engine(){

        return $this->success([
            ['id' => 1,'engine' => '']
        ]);
    }

    /**
     * 获取语言
     * @return Json
     */
    public function sensitiveWord(): Json
    {
        return $this->success([
            ['en' => 'test,tg,fast,word'],
            ['zh' => '测试,飞机,快速,单词'],
        ]);
    }
}