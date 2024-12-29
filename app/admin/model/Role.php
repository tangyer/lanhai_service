<?php

namespace app\admin\model;

use app\common\model\BaseModel;

class Role extends BaseModel
{
    protected array $searchField = ['role_name|like','status'];
}