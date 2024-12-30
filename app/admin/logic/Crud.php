<?php

namespace app\admin\logic;

use think\facade\Db;
use think\facade\Log;

class Crud
{
    protected string $actionName = '';

    protected string $className  = '';
    protected string $appName = 'admin';

    protected array $searchData = [];

    protected array $requireData = [];

    protected array $dictData = [];
    protected array $formTypeData = [];

    protected array $commentData = [];

    public function getTables(){
        $list = Db::getTables();
        $prefix = env('database.prefix');
        return array_map(function ($table) use ($prefix){
            return str_replace($prefix, '',$table);
        },$list);
    }

    public function getTable($table){
        $prefix = env('database.prefix');
        $list = Db::query('show full columns from '.$prefix.$table);
        $data = [];
        foreach ($list as $k=>$v){
            $temp['field'] = $v['Field'];
            $temp['type'] = $v['Type'];
            $temp['comment'] = $v['Comment'];
            $data[] = $temp;
        }
        return $data;
    }

    public function save($data)
    {
//        dd( array_keys($data['search']));
        $tableName = $data['table_name'];
        $this->className = parse_name($tableName,1);
        $this->appName = $data['app_name'];
        $this->searchData = $data['search'] ?? [];
        $this->requireData = $data['require'] ?? [];
        $this->formTypeData = $data['form_type'] ?? [];
        $this->dictData = $data['dict'] ?? [];
        $this->commentData = $data['comment'] ?? [];
        $isNode = $data['is_node'] ?? 0;
        if ($isNode){
            $nodeData = $data['node'];
            $url =  lcfirst($this->className).'/index';
            // 创建节点  需根据URL判断，有则修改 无则创建
            $nodeModel = \app\admin\model\Node::where(['url' => $url,'app_type' => $this->appName])->findOrEmpty();
            if ($nodeModel->isEmpty()){
                $nodeModel->url = $url;
                $nodeModel->title = $nodeData['title'];
                $nodeModel->parent_id = $nodeData['parent_id'];
                $nodeModel->sort = $nodeData['sort'] ?? 99;
                $nodeModel->type = 1;
                $nodeModel->status = 1;
                $nodeModel->app_type = $data['app_name'];
                $nodeModel->save();
            }
//            $node = $data['node'];
//            $node['url'] = lcfirst($className).'/index';
//            $node['sort'] = 50;
//            $node['type'] = 1;
//            $node['status'] = 1;
//            $node['app_type'] = $data['app_name'];
//            \app\admin\model\Node::create($node);

        }

        //生成代码

        //生成Controller Logic 以及 Model Validate
        $this->genClass();
        // 生成View
        if ($data['is_view']){
            $this->makeView();
        }
    }
    /**
     * 生成控制器 模型 逻辑
     * @return void
     */
    private function genClass(): void
    {
        $actions = ['controller','model','logic'];
        foreach ($actions as $action){
            $this->actionName = $action;
            $this->buildClass();
        }
        $this->actionName = 'validate';
        $this->makeValidate();
    }


    private function buildClass():void
    {
        $class = $this->getClassName();
        $path = $this->getPathName($class);
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        $stub = file_get_contents($this->getStub($this->actionName));

        $namespace = trim(implode('\\', array_slice(explode('\\', $class), 0, -1)), '\\');

        $class = str_replace($namespace . '\\', '', $class);
        if ($this->actionName == 'model'){
            // 搜索查询字段
            $searchField = '';
            if ( $this->searchData){
                $searchField = ' protected array $searchField = [';
                foreach ($this->searchData as $field ){
                    $searchField .= "'".$field."',";
                }
                $searchField = rtrim($searchField,',');
                $searchField .= '];';
            }
            // MYSQL 查询字段
            $selectField = '';
            $softDel = '';
            if ($this->commentData){
                $softDel = 'protected $softDel = false;'; //配置软删除
                $selectField = 'protected string $selectField = ' . '\'';
                foreach ($this->commentData as $field => $val ){
                    if ($field == 'deleted') {
                        $softDel = ''; // 为空时 默认软删除
                        continue;
                    };
                    $selectField .= $field.',';
                }
                $selectField = rtrim($selectField,',');
                $selectField .= '\';';
            }
            file_put_contents($path,str_replace(['{%className%}', '{%namespace%}','{%selectField%}','{%searchField%}',' {%softDel%}'], [
                $class,
                $namespace,
                $selectField,
                $searchField,
                $softDel
            ], $stub));
        }
        if ($this->actionName == 'controller'){
            file_put_contents($path,str_replace(['{%className%}', '{%namespace%}','{%App%}'], [
                $class,
                $namespace,
                ucfirst($this->appName)
            ], $stub));
        }
        if ($this->actionName == 'logic'){
            file_put_contents($path,str_replace(['{%className%}', '{%namespace%}'], [
                $class,
                $namespace,
            ], $stub));
        }

    }

    protected function makeValidate(){

        $class = $this->getClassName();
        $path = $this->getPathName($class);

        $rules = '['.PHP_EOL;
        foreach ($this->requireData as $field){
            $rules .= '        \''.$field.'|'.$this->commentData[$field].'\' => \'require\','.PHP_EOL;
        }
        $rules .= '    ];';

        $stub = file_get_contents($this->getStub($this->actionName));

        $namespace = trim(implode('\\', array_slice(explode('\\', $class), 0, -1)), '\\');

        $className = str_replace($namespace . '\\', '', $class);

        $stub = str_replace(['{%className%}', '{%namespace%}','{%rules%}'], [
            $className,
            $namespace,
            $rules
        ], $stub);
        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $stub);
    }

    protected function makeView()
    {

        $views = ['index','create','update','detail'];
        $basePath = base_path() . DIRECTORY_SEPARATOR . $this->appName . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . parse_name($this->className).DIRECTORY_SEPARATOR;
        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }
        foreach ($views as $view){
            $path = $basePath . $view.'.html';
            file_put_contents($path, $this->buildHtml($view));
        }

    }
    protected function buildHtml(string $viewName): array|bool|string
    {
        $stub = file_get_contents($this->getStub($viewName,DIRECTORY_SEPARATOR.'view'));
        // 创建列表
        if ($viewName === 'index'){
            $searchStr = '';
            // 创建搜索条件
            if ($this->searchData){
                foreach ($this->searchData as $field){
                    $form = '     <input type="text"  name="'.$field.'"  id="'.$field.'">';
                    $formType = $this->formTypeData[$field] ?? 'input';
                    if ($formType == 'no') continue;
                    if ($formType == 'select' || $formType == 'radio' || $formType == 'checkbox'){
                        $dictType = $this->dictData[$field] ?? [];
                        $form = '   <select class=" select2" id="'.$field.'"  name="'.$field.'"  >'.PHP_EOL;
                        $form .= '    <option value="">请选择</option>'.PHP_EOL;
                        if ($dictType){
                            $form .= '      {volist name=":get_dict(\''.$dictType.'\')" id="dict"}'.PHP_EOL;
                            $form .= '        <option  value="{$dict.dict_value}" >{$dict.dict_label}</option>'.PHP_EOL;
                            $form .= '      {/volist}';
                        }
                        $form.= PHP_EOL.'</select>';
                    }
                    $searchStr .= '    <li>'. PHP_EOL;
                    $searchStr .= '         '.$this->commentData[$field]. PHP_EOL;
                    $searchStr .= '         '.$form.PHP_EOL;
                    $searchStr .= '    </li>'. PHP_EOL;
                }
            }
            return str_replace(['{%searchField%}', '{%className%}', '{%script%}'],[
                $searchStr,
                lcfirst($this->className),
                $this->makeJs()
            ],$stub);
        }else{
            // 创建表单
            if ($viewName == 'create' || $viewName == 'update'){
                $str = '' ;
                foreach ($this->commentData as $field => $name ){

                    if ($field == 'id' || $field == 'create_time' || $field == 'deleted') continue;

                    $formType = $this->formTypeData[$field] ?? ''; // 表单类型

                    if ($formType == 'no') continue;

                    $dictType = $this->dictData[$field]; // 字典类型

                    $required = ''; // 是否必填

                    if (in_array($field, $this->requireData)){
                        $required = 'required';
                    }

                    $class = ''; // 表单class 属性 用来绑定事件 比如时间

                    $form = ''; // 表单HTML


                    // 文本框 或者时间
                    if ($formType == 'input' || $formType == 'date'){
                        $value = $viewName == 'update' ? 'value="{$model.'.$field.'}"' : '';
                        $class = $formType == 'date' ? 'time-input' : '';
                        $form = '<input  type="text" id="'.$field.'" class="form-control '.$class.'" placeholder="请输入'.$name.'" name="'.$field.'" '.$value.' '.$required.' />';
                    }

                    // 文本域
                    if ($formType == 'textarea'){
                        $value = $viewName == 'update' ? '{$model.'.$field.'}' : '';
                        $form = '<textarea rows="5"  id="'.$field.'" class="form-control '.$class.'" placeholder="请输入'.$name.'" name="'.$field.'"  '.$required.'>'.$value.'</textarea>';
                    }
                    // 下拉框
                    if ($formType == 'select'){
                        $value = $viewName == 'update' ? '{$model.'.$field.'}' : '';
                        $form = '<select class="form-control select2" id="'.$field.'" data-value="'.$value.'" name="'.$field.'"   '.$required.' >'.PHP_EOL;
                        $form .= '  <option value="">请选择</option>'.PHP_EOL;
                        if ($dictType){
                            $form .= '{volist name=":get_dict(\''.$dictType.'\')" id="dict"}'.PHP_EOL;
                            $form .= '    <option  value="{$dict.dict_value}" >{$dict.dict_label}</option>'.PHP_EOL;
                            $form .= '{/volist}';
                        }
                        $form.= PHP_EOL.'</select>';
                    }

                    // 单选框
                    if ($formType == 'radio'){
                        if ($dictType){
                            $form = '{volist name=":get_dict(\''.$dictType.'\')" id="dict"}'.PHP_EOL;
                            if ($viewName == 'update'){
                                $checked = '{$dict.dict_value == $model.'.$field.' ? "checked" : ""}';
                            }else{
                                $checked = '{$dict.is_default == 1 ? "checked" : ""}';
                            }

                            $form .= '<div class="radio-box">'.PHP_EOL;
                            $form .= '    <input type="radio" id="'.$field.'_{$dict.dict_value}" name="'.$field.'" value="{$dict.dict_value}" '.$checked.'>'.PHP_EOL;
                            $form .= '    <label for="'.$field.'_{$dict.dict_value}" >{$dict.dict_label}</label>'.PHP_EOL;
                            $form .= '</div>'.PHP_EOL;
                            $form .= '{/volist}';
                        }
                    }

                    // 复选框
                    if ($formType == 'checkbox'){
                        if ($dictType){
                            $form = '{volist name=":get_dict(\''.$dictType.'\')" id="dict"}'.PHP_EOL;
                            if ($viewName == 'update'){
                                $checked = '';
                            }else{
                                $checked = '{$dict.is_default == 1 ? "checked" : ""}';
                            }

                            $form .= ' <label  class="check-box">'.PHP_EOL;
                            $form .= '    <input type="checkbox" id="'.$field.'_{$dict.dict_value}" name="'.$field.'[]" value="{$dict.dict_value}" '.$checked.'>'.PHP_EOL;
                            $form .= '    {$dict.dict_label}'.PHP_EOL;
                            $form .= '</label>'.PHP_EOL;
                            $form .= '{/volist}';
                        }
                    }

                    //上传 目前需修改表单 加入上传JS文件
                    if ($formType == 'upload'){
                        $value = '';
                        $img = '';
                        if ($viewName == 'update'){
                            $value = 'value="{$model.'.$field.'}"';
                            $img = ' <img src="{$model.'.$field.'}" style="max-width: 100px;">';
                        }
                        $form = ' <button type="button" class="btn btn-sm btn-primary upload" id="btn-image-'.$field.'" data-title="图片"  data-to="'.$field.'">点击上传</button>
                        <div class="pl-content m-t-xs">'.$img.'</div>
                        <input  type="hidden" id="'.$field.'" class="form-control" name="'.$field.'" '.$value.' '.$required.'/>';
                    }

                    $str .= '    <div class="form-group">'. PHP_EOL;
                    $str .= '       <label  class="col-sm-3 control-label '.($required ? 'is-required' : '').'" >'.$name.'</label>'. PHP_EOL;
                    $str .= '        <div class="col-sm-8">'. PHP_EOL;
                    $str .= '           '.$form. PHP_EOL;
                    $str .= '        </div>'. PHP_EOL;
                    $str .= '    </div>'. PHP_EOL;
                }
                return str_replace(['{%form%}', '{%className%}'],[
                    $str,
                    lcfirst($this->className),
                ],$stub);
            }
            //创建详情
            if ($viewName === 'detail'){
                $str = '';
                foreach ($this->commentData as $field => $name ){
                    $str .= '    <div class="form-group row">'. PHP_EOL;
                    $str .= '        <label class="col-sm-3 control-label" >'.$name.'</label>'. PHP_EOL;
                    $str .= '        <div class="col-sm-6">'. PHP_EOL;
                    $str .= '            <p class="form-control-plaintext">{$model.'.$field.'}</p>'. PHP_EOL;
                    $str .= '        </div>'. PHP_EOL;
                    $str .= '    </div>'. PHP_EOL;
                }
                return str_replace('{%detail%}',$str,$stub);
            }
        }

        return '';

    }

    protected function makeJs(): array|bool|string
    {
        $columnStr = '{checkbox:true},' . PHP_EOL;

        $dictData = '';

        foreach ($this->dictData as $dictType){
            if ($dictType){
                $dictData .= "var ".parse_name($dictType,1,false)." = JSON.parse('{:get_dict(\"".$dictType."\",true)}') ;".PHP_EOL;
            }
        }

        foreach ($this->commentData as $field => $name){

            $formType = $this->formTypeData[$field] ?? ''; // 表单类型

            if ($formType == 'no') continue;

            $formatter = ''; // 格式化显示
            $dictType = $this->dictData[$field] ?? '';
            if ($dictType){
                $formatter = ',formatter:function (value){
                    return $.table.selectDictLabel('.(parse_name($dictType,1,false)).',value)
                }';
            }

            if ($field === 'id' || $field === 'deleted'){
                continue;
            }
            $columnStr .= '            {field:"'.$field.'",title:"'.$name.'" '.$formatter.'},' . PHP_EOL;
        }

        $stub = file_get_contents($this->getStub('js',DIRECTORY_SEPARATOR.'view'));

        return str_replace(['{%className%}','{%dictData%}','{%columns%}'],[
            lcfirst($this->className),
            $dictData,
            $columnStr,
        ],$stub);

    }


    protected function getPathName(string $name): string
    {
        $name = str_replace('app\\', '', $name);

        return app()->getBasePath() . ltrim(str_replace('\\', '/', $name), '/') . '.php';
    }

    protected function getClassName(): string
    {
        return $this->getNamespace() . '\\' . $this->className;
    }

    protected function getNamespace(): string
    {
        return 'app' . '\\' . $this->appName.'\\'.$this->actionName;
    }

    protected function getStubPath($path = ''): string
    {
        $basePath =  app_path().
                'view'. DIRECTORY_SEPARATOR .
                'crud'. DIRECTORY_SEPARATOR .
                'template' . DIRECTORY_SEPARATOR ;

        return  $path ? $basePath. $path . DIRECTORY_SEPARATOR : $basePath;
    }

    protected function getStub($name = '',$path = ''): string
    {
        $name = $name ?: $this->actionName;

        return $this->getStubPath($path) . $name . '.stub';
    }
}