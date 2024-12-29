<?php

namespace app\admin\controller;

use think\response\Json;

class Ajax extends Base
{
    /**
     * 获取顶级节点
     * @param \app\admin\logic\Node $node
     * @return Json
     */
    public function node(\app\admin\logic\Node $node){
        return $this->success($node->getRootNode($this->request->param()));
    }

    /**
     * 获取角色
     * @param \app\admin\logic\Role $role
     * @return Json
     */
    public function role(\app\admin\logic\Role $role){
        return $this->success($role->getValidRole());
    }


    /**
     * 获取文章分类
     * @param \app\admin\logic\Category $category
     * @return Json
     */
    public function category(\app\admin\logic\Category $category){
        return $this->success($category->getAll(['status' => 1])->toArray());
    }

    /**
     * 上传
     * @return Json
     */
    public function upload()
    {
        // 获取表单上传文件
        $file = request()->file('file');
        validate(['file'=> 'fileSize:10240000|fileExt:jpg,png,jpeg,gif'])->check(['file' => $file]);
        $res = \think\facade\Filesystem::putFile( '', $file);
        $res = '/uploads/'.str_replace('\\','/',$res);
        return  $this->success(['path' => $res]);
    }
}