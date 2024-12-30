<?php

namespace app\admin\logic;

use app\common\logic\BaseLogic;

class Role extends BaseLogic
{
    /**
     * 设置状态
     * @param $id
     * @param $status
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     */
    public function setStatus($id,$status){
        $this->model->setFieldValue(['id' => $id],'status',$status);
    }

    /**
     * 获取有效角色
     * @return array
     */
    public function getValidRole(){
        return $this->model->getAll(['status' => 1])->toArray();
    }
}