<?php
declare (strict_types = 1);

namespace app\merchant\model;
use app\common\model\BaseModel;
/**
 * @mixin \think\Model
 */
class Keyword extends BaseModel
{

    protected string $aliasName = 'kw';

     protected string $selectField = 'id,merchant_id,keyword,keyword_type,keyword_type.type_name,is_refuse,create_time';

      protected array $searchField = ['merchant_id','keyword','keyword_type','is_refuse'];

    protected $softDel = false;

    protected array $join = [
        ['keyword_type' , 'keyword_type.id = kw.keyword_type']
    ];
}
