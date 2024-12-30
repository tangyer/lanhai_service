<?php


namespace app\common\traits;
use app\common\logic\BaseLogic;
use app\common\provider\Result;
use think\response\Json;

trait Action
{
    protected BaseLogic $logic ;

    protected function init(): void
    {
        parent::init();
        $this->setLogic();
    }

    /**
     * 获取逻辑层实例
     * @return void
     */
    protected function setLogic(): void
    {
        $this->logic = invoke(str_replace('controller','logic',static::class));
    }




}