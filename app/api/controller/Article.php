<?php
declare (strict_types = 1);

namespace app\api\controller;
use app\common\traits\AdminAction;
use think\response\Json;

class Article extends Base
{

    public function index(\app\api\logic\Article $article){
        $request = $this->request;
        return $this->success($article->getList($this->request->param())->each(function ($item) use ($request){
            $item->image = $request->domain().$item->image;
        })->toArray());
    }

    /**
     * 获取文章分类
     * @param \app\api\logic\Category $category
     * @return Json
     */
    public function category(\app\api\logic\Category $category){
        return $this->success($category->getAll(['status' => 1])->toArray());
    }
}
