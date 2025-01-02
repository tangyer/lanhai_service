<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;

class WorkOrderAccount extends BaseLogic
{
    /**
     * @param array $where
     * @return mixed|\think\Collection|\think\Paginator
     */
    public function getList(array $where = [])
    {
        return $this->model->getList($where)->each(function($item, $key){
            $item->online_time = $item->online_time ? date('Y-m-d H:i:s' , $item->online_time) :'';
            $item->offline_time = $item->offline_time ? date('Y-m-d H:i:s' , $item->offline_time) :'';
        });
    }

    public function save(array $data)
    {
        $data['online_time'] = strtotime($data['online_time']);
        $data['offline_time'] = strtotime($data['offline_time']);
        $id = $data['id'] ?? 0;
        if ($id){
            return $this->update($data);
        }else{
            return $this->create($data);
        }
    }
}
