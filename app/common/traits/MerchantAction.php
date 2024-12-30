<?php

namespace app\common\traits;

use app\common\provider\Result;
use think\response\Json;

trait MerchantAction
{
    use Action;

    private function getParams(){
        $user = get_user();
        if (IS_GET){
            $params = $this->request->get();
        }else{
            $params = $this->request->post();
            $params['create_user'] = $user['id'];
        }
        $params['merchant_id'] = $user['merchant_id'];
        return $params;
    }
    /**
     * 列表
     * @return mixed
     */
    public function index(): mixed
    {
        if (IS_AJAX){

            return $this->success($this->logic->getList($this->getParams())->toArray());
        }
        return $this->fetch();
    }

    public function create(){
        return $this->fetch();
    }

    public function update($id){
        return $this->fetch('update',[
            'model' =>  $this->findModel($id)
        ]);
    }

    /**
     * 保存
     * @return mixed
     */
    public function save(){
        if(IS_POST){
            $this->logic->save($this->getParams());
            return $this->success() ;
        }
    }

    /**
     * 根绝ID获取详情
     * @param int $id
     * @return string
     */
    public function detail(int $id){
        return $this->fetch('detail',[
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * 删除 支持单个删除 和 批量删除
     * @return mixed
     */
    public function delete(): mixed
    {
        if (IS_POST){
            $ids 	= $this->request->post('ids','');
            if (empty($ids)){
                return $this->error(Result::PARAM_ERROR,' 参数错误');
            }
            $this->logic->delete(!str_contains($ids, ',') ? $ids : explode(',',$ids));
            return $this->success([],'删除成功');
        }else{
            return  $this->error(Result::METHOD_ERROR,'请求方式不允许');
        }
    }

    /**
     * 修改状态
     * @return Json
     */
    public function changeStatus(): Json
    {
        if (IS_POST){
            $id = $this->request->post('id/d');
            $status = $this->request->post('status/d');
            $this->logic->setStatus($id, $status);
            return $this->success();
        }
        return  $this->error(Result::METHOD_ERROR);
    }


    /**
     * 获取单个模型信息
     * @param $id
     * @return mixed
     */
    protected function findModel($id): mixed
    {
        return $this->logic->findOneById((int) $id );
    }

}