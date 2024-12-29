<?php


namespace app\common\logic;
use app\common\model\BaseModel;
use think\exception\HttpException;
use think\exception\ValidateException;


class BaseLogic
{
    protected BaseModel $model ;

    public function __construct()
    {
        $this->init();
        $this->setModel();
    }

    protected function init(){

    }

    /**
     * 获取分页列表
     * @param array $where
     * @return mixed
     */
    public function getList(array $where = []){
        return $this->model->getList($where);
    }

    /**
     * 获取分页列表
     * @param array $where
     * @param int $page 页码
     * @param int $limit 
     * @return mixed
     */
    public function getListByPage(array $where = [], int $page = 0, int $limit = 0){
        return $this->model->getListByPage($where,$page,$limit);
    }

    /**
     * 根据获取单个数据
     * @param int $id
     * @return mixed
     */
    public function findOneById(int $id){
        return $this->findOne(['id' => $id]);
    }

    /**
     * 获取单个数据
     * @param array $where
     * @param bool $failException
     * @return mixed
     */
    public function findOne(array $where = [], bool $failException = true){
        return $this->model->findOne($where,$failException);
    }

    /**
     * 获取全部数据
     * @param array $where
     * @return mixed
     */
    public function getAll(array $where = []){
        return $this->model->getAll($where);
    }

    /**
     * 验证字段的有效性
     * @param array $data 要验证的数据
     * @param string $scene 验证场景
     * @return bool
     */
    public function validate(array $data, string $scene = ''): bool
    {
        $class = $this->getValidateClass();
        if (class_exists($class)) {
            validate($class)->scene($scene)->check($data);
        }
        return true;
    }

    /**
     * 抛出验证异常
     * @param string $message
     */
    public function validateError(string $message = ''){
        throw new ValidateException($message);
    }


    /**
     * 添加数据
     * @param array $data
     * @return bool
     */
    public function create(array $data = []): bool
    {
        $this->validate($data);
        return $this->model->save($data);
    }

    /**
     * 修改数据
     * @param array $data
     * @return bool
     */
    public function update(array $data = []): bool
    {
        $this->validate($data);
        $id = $data['id'] ?? 0;
        if ($id){
            return $this->findOneById($id)->save($data);
        }
        return false;
    }

    /**
     * 保存数据
     * @param array $data
     * @return bool
     */
    public function save(array $data){
        $id = $data['id'] ?? 0;
        if ($id){
           $res = $this->update($data);
        }else{
            $res =  $this->create($data);
        }
        $this->after();

        return $res;

    }

    /**
     * 设置数据
     * @param array $where
     * @param string $field
     * @param mixed $value
     * @return bool
     */

    public function setFieldValue(array $where = [], string $field = '',  $value = '') {
        return $this->model->setFieldValue($where,$field,$value);
    }

    /**
     * 获取某个字段的值
     * @param array $where 查询条件
     * @param string $field 查询字段
     * @param mixed $default 默认值
     * @return mixed
     */
    public function getFieldValue(array $where = [], string $field = '', $default = '') {
        return $this->model->getFieldValue($where,$field, $default);
    }

    /**
     * 根据id删除数据
     * @param integer|array $id
     * @return boolean
     */
    public function delete($id): bool
    {
        $res = $this->model->deleteById($id);
        $this->after();
        return $res;
    }

    public function after()
    {

    }

    /**
     * 设置状态
     * @param $id
     * @param $status
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     */
    public function setStatus($id,$status){
        $this->model->setFieldValue(['id' => $id],'status',$status);
        $this->after();
    }


    /**
     * 设置模型实例
     */
    protected function setModel(){
        $class = str_replace('logic','model',static::class);
        if (!class_exists($class)){
            $class = 'app\common\model\\'.class_basename(static::class);
        }
        $this->model = invoke($class);

    }

    /**
     * 获取模型实例
     */
    public function getModel(): BaseModel
    {
        return $this->model;
    }

    /**
     * 获取验证实例
     * @return string
     */
    protected function getValidateClass(): string
    {
        return str_replace('logic','validate',static::class);
    }


}