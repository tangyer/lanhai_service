<?php

declare (strict_types = 1);

namespace app\common\model;
use think\Collection;
use think\facade\Log;
use think\Model;
use think\db\exception\DataNotFoundException;
use think\Paginator;

/**
 * 系统通用逻辑模型
 */
abstract class BaseModel extends Model
{
    /**
     * 正常数据
     * @var int
     */
    const DATA_NORMAL = 0;

    /**
     * 已删除数据
     * @var int
     */
    const DATA_DELETE = 1;

    /**
     * 分页数据条数
     * @var int
     */
    const PAGE_SIZE   = 10;

    /**
     * 查询对象
     */
    protected $query;

    /**
     * 表别名
     * @var string
     */
    protected string $aliasName = '';

    /**
     * sql查询字段
     * @var string
     */
    protected string $selectField = '';

    /**
     * 条件查询字段
     * @var string|array
     */
    protected array $searchField = [];

    /**
     * 连接查询
     * @var array
     */
    protected array $join = [];

    /**
     * 是否分页
     */
    protected bool $paginate = true;

    /**
     * 排序字段
     * @var string
     */
    protected string $sort = 'id';

    /**
     * 排序类型
     */
    protected string $sortOrder = 'desc';

    /**
     * 是否逻辑删除
     * @var string|false
     */
    protected $softDel = 'deleted';

    /**
     * 设置某个字段值
     * @param array $where 查询条件
     * @param string $field 字段名
     * @param mixed $value 设置字段的值
     * @return bool
     * @throws DataNotFoundException
     */
    public function setFieldValue(array $where = [], string $field = '',  $value = ''): bool
    {
        $model = $this->findOne($where);
        $model->$field = $value;
        return $model->save();
    }

    /**
     * 获取某个字段的值
     * @param array $where 查询条件
     * @param string $field 查询字段
     * @param string|null $default 默认值
     * @return mixed
     */
    public function getFieldValue(array $where = [], string $field = '',  $default = null) {
        return $this->where($where)->value($field, $default);
    }


    /**
     * 根据where条件删除数据
     * @param array $where 查询条件
     * @return boolean
     */
    public function deleteByWhere(array $where = []): bool
    {
        if ($this->softDel) {
            $this->where($where)->update([$this->softDel => self::DATA_DELETE]);
        } else {
            $this->where($where)->delete();
        }
        return true;
    }

    /**
     * 根据id删除数据
     * @param integer|array $id
     * @return boolean
     */
    public function deleteById($id): bool
    {
        return $this->deleteByWhere(['id' => $id]);
    }

    /**
     * 获取某个列的数组
     * @param array $where 查询条件
     * @param string $field 查询字段
     * @param string $key 键值
     * @return array
     */
    public function getColumn(array $where = [], string $field = '', string $key = '') {
        if ($this->softDel){
            $where[$this->softDel] = self::DATA_NORMAL;
        }
        return $this->where($where)->column($field, $key);
    }

    /**
     * 获取数量
     * @param array $where 查询条件
     * @return integer
     */
    public function getCount(array $where = []) {
        if ($this->softDel){
            $where[$this->softDel] = self::DATA_NORMAL;
        }
        return $this->where($where)->count();
    }

    /**
     * 根据id 获取单条数据
     * @param int $id id值
     * @return array|Model
     * @throws DataNotFoundException
     */
    public function findOneById(int $id) {
       return $this->findOne(['id'=> $id]);
    }

    /**
     * 获取单条数据
     * @param array $where 查询条件
     * @param boolean $failException 是否跑出异常
     * @return array|Model
     * @throws DataNotFoundException
     */
    public function findOne(array $where = [], bool $failException = true) {
        if ($this->softDel){
            $where[$this->softDel] = self::DATA_NORMAL;
        }
       // 关联查询
        if ($this->join){
           return  $this->getQuery($where)->find();
        }
        if ($model = $this->where($where)->find()) {
            return $this->softDel ? $model->hidden([$this->softDel]) : $model;
        }
        if (!$failException){
            return null;
        }
        throw new DataNotFoundException('数据不存在');
    }

    /**
     * 数据是否已被删除
     * @return bool
     */
    public function isDelete(): bool
    {
        $delField = $this->softDel;
        return $this->$delField === static::DATA_DELETE;
    }

    /**
     * 获取列表数据
     * @param array $where 前台传入的数据
     * @return Paginator|Collection
     */
    public function getList(array &$where = []) {
        // 设置分页
        if ($this->paginate) {
            return $this->getQuery($where)->paginate((int)$where['pageSize'] ?? self::PAGE_SIZE);
        }
        return $this->getQuery($where)->select();
    }

    /**
     * 获取全部数据
     * @param array $where 前台传入的数据
     * @return Collection
     */
    public function getAll(array $where = []): Collection
    {
        return $this->getQuery($where)->select();
    }

    /**
     * 获取指定数量集合
     * @param array $where
     * @param int $limit
     * @return mixed
     */
    public function getListByLimit(array $where = [], int $limit = 0){
        return $this->getQuery($where)->limit($limit)->select();
    }

    /**
     * 获取指定数量集合
     * @param array $where
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function getListByPage(array $where = [], int $page = 0, int $limit = 0){
        return $this->getQuery($where)->page($page,$limit > 0 ? $limit : self::PAGE_SIZE)->select();
    }

    /**
     * 获取查询对象
     * @param array $where
     * @return mixed
     */
    protected function getQuery(array &$where = []){
        $this->setAliasName();
        // 关联查询
        if ($this->join){
            $this->setJoin();
        }
        // 设置查询字段
        if ($this->selectField) {
            $this->setSelect();
        }
        // 设置排序
        if ($this->sort){
            $this->setOrder($where);
        }
        // 设置查询条件
        $this->setWhere($where);

        return $this->query;
    }

    /**
     * 设置表别名
     * @return mixed
     */
    protected function setAliasName(){
        $this->aliasName = $this->aliasName ?: mb_strtolower(class_basename($this));
        $this->query = $this->alias($this->aliasName);
        return $this->query;
    }

    /**
     * 设置字段
     * @param string $field 字段名称
     * @return string
     */
    protected function setAliasField(string $field = ''): string
    {
        return strpos($field,'.') === false ? $this->aliasName.'.'.$field : $field;
    }

    /**
     * 设置查询字段
     */
    protected function setSelect() {
        $selectField = explode(',', $this->selectField);
        $fields = array_map([$this, 'setAliasField'],$selectField);
        $this->query->field($fields);
    }

    /**
     * where条件组装
     * @param array $where 筛选条件
     */
    protected function setWhere(array &$where = []){
        $condition = $this->softDel ? [
            [$this->setAliasField($this->softDel) , '=' , self::DATA_NORMAL]
        ] : [];
        if ($where && $this->searchField){
            // 过滤条件
            foreach ($this->searchField as $searchField) {
                $type = '=';
                if (strpos($searchField,'|') !== false) {
                    $fieldArr = explode('|',$searchField);
                    $searchField = $fieldArr[0];
                    $type    = $fieldArr[1];
                }
                $field = $searchField;
                $prefix = $this->aliasName;
                //带关联表字段查询
                if (strpos($searchField,'.') !== false) {
                    list($prefix,$field) = explode('.', $searchField);
                }
                if (isset($where[$field]) && $where[$field] !== '') {
                    $value = is_string($where[$field]) ? trim($where[$field]) : $where[$field];
                    if (is_array($value)){
                        $type = 'in';
                    }
                    $field = $prefix . '.' . $field;
                    switch ($type){
                        case 'like':
                            $value = '%'.$value.'%';
                            break;
                        case 'between':
                            $value = [$where($fieldArr[2]),$where[$fieldArr[3]]];
                            break;
                        default:
                            break;
                    }
                    $condition[] = [$field,$type,$value];
                }

            }
        }
        $this->query->where($condition);
    }

    /**
     * 排序设置
     * @param array $where
     */
    protected function setOrder(array &$where = []){
        $this->sort = $where['sort'] ?? $this->sort;
        $this->sortOrder = $where['order'] ?? $this->sortOrder;
        $this->query->order($this->setAliasField($this->sort),$this->sortOrder);
        unset($where['sort'],$where['order']);
    }

    /**
     * 连接查询
     */
    protected function setJoin(){
        foreach ($this->join as $v) {
            $join = $v[0] ?? '';
            $condition = $v[1] ?? '';
            $type = $v[2] ?? 'inner';
            if (empty($join) || empty($condition)) {
                continue;
            }
            $this->query->join($join, $condition, $type);
        }
    }

    
}
