<?php
declare (strict_types = 1);

namespace app\merchant\logic;
use app\common\logic\BaseLogic;

class KeywordType extends BaseLogic
{
    public function delete($id): bool
    {
        if(!is_array($id)){
//            $count =
        }

        $res = $this->model->deleteById($id);

        return $res;
    }
}
