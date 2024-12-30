<?php

namespace app\api\controller;

use app\common\provider\Result;

class Lang extends Base
{
    public function index(){

        return $this->success(config('lh.lang'));
    }
}
