<?php

namespace app\merchant\model;

use app\common\model\BaseModel;

class Node extends BaseModel
{
    protected bool $paginate = false;

    protected array $searchField = ['title|like','parent_id','status','app_type'];

    protected string $sort = 'sort';

    protected string $sortOrder = 'desc';

    protected string $selectField = 'id,title,parent_id,url,sort,icon,type,status,app_type';
}