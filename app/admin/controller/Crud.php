<?php

namespace app\admin\controller;

use app\common\controller\BaseController;
use think\facade\Db;
use think\response\Json;

class Crud extends BaseController
{
    private \app\admin\logic\Crud $logic;

    protected function init(): void
    {
        $this->logic = new \app\admin\logic\Crud();
    }

    public function index(): string
    {
        return $this->fetch('generate',[
            'tables' => $this->logic->getTables()
        ]);
    }

    /** 获取表结构
     * @param $tableName
     * @return Json
     */
    public function getTable($tableName): Json
    {
        return $this->success($this->logic->getTable($tableName));
    }

    public function save(){
        $params = $this->request->post();
//        dd(parse_name($params['table_name'],1,0));
        $this->logic->save($params);
        return $this->success();

    }


}