<?php

namespace app\merchant\logic;

use app\common\logic\BaseLogic;
use app\admin\model\Role;


class Node extends BaseLogic
{
    /**
     * 获取功能菜单
     */
    public function getTreeNodeByPerms(): array
    {
        $role = Role::find(get_user('role_id'));
        $where = [
            'type' => 1,
            'app_type' => 'merchant',
            'status'    => 1
        ];
        if($role && $role['id'] > 1){
            $where['id'] = explode(',',$role->rules);
        }
        return list_to_tree($this->getAll($where)->toArray());
    }

    /**
     * 获取顶级节点
     * @param array $where
     * @return array
     */
    public function getRootNode(array $where = []): array
    {
        $where['parent_id'] = 0;
        return $this->getAll($where)->each(function ($item) {
//            $item->app_type == 'admin' ? $item->title = $item->title . '-后台' : $item->title = $item->title . '-商户';
            return $item;
        })->toArray();
    }
}