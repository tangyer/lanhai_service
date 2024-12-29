<?php
declare (strict_types = 1);

namespace app\common\model;

use think\Collection;
use think\helper\Arr;
use think\Model;

/**
 * @mixin \think\Model
 */
class Dict extends Model
{
    protected string $selectField = 'dict_label,dict_value,dict_type,list_class,is_default';

    public  function getList(): array
    {
        $list = $this->where(['status' => 1])->field($this->selectField)->select()->toArray();
        $data = [];
        foreach ($list as $item){
            $dictType = $item['dict_type'];
            unset($item['dict_type']);
            $data[$dictType][] = $item;
        }
        return $data;

    }

}
