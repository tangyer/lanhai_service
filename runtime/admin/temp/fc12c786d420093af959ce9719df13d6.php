<?php /*a:4:{s:67:"D:\phpstudy_pro\WWW\LanHaiService\app\admin\view\crud\generate.html";i:1735208060;s:67:"D:\phpstudy_pro\WWW\LanHaiService\app\admin\view\layout\layout.html";i:1735125879;s:65:"D:\phpstudy_pro\WWW\LanHaiService\app\admin\view\public\form.html";i:1694898196;s:63:"D:\phpstudy_pro\WWW\LanHaiService\app\admin\view\public\js.html";i:1734774942;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title ></title>
  <link href="/static/css/bootstrap.min.css?v=3.3.8" rel="stylesheet"/>
  <link href="/static/css/font-awesome.min.css?v=4.7.4" rel="stylesheet"/>
  <!-- bootstrap-table 表格插件样式 -->
  <link href="/static/ajax/libs/bootstrap-table/bootstrap-table.min.css?v=1.18.3" rel="stylesheet"/>
  <link href="/static/css/animate.min.css?v=20210831" rel="stylesheet"/>
  <link href="/static/css/style.css?v=20210831" rel="stylesheet"/>
  <link href="/static/ruoyi/css/ry-ui.css?v=4.7.4" rel="stylesheet"/>
  <!--富文本编辑器-->
  <link href="/static/ajax/libs/summernote/summernote.css" rel="stylesheet"/>
  <link href="/static/ajax/libs/select2/select2.min.css?v=4.0.13" rel="stylesheet"/>
  <link href="/static/ajax/libs/select2/select2-bootstrap.min.css?v=4.0.13" rel="stylesheet"/>
</head>
<body>

<!-- ./ preloader -->
<div class="wrapper wrapper-content animated fadeInRight" >

    <div class="nav-tabs-custom" >
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-basic" data-toggle="tab" aria-expanded="false">基本信息</a></li>
            <li ><a href="#tab-field" data-toggle="tab" aria-expanded="false">字段信息</a></li>
<!--            <li><a href="#tab-gen" data-toggle="tab" aria-expanded="false">生成信息</a></li>-->
            <li class="pull-right header">
                <i class="fa fa-code"></i> 生成配置
            </li>
        </ul>
        <form class="form-horizontal m" id="hr-form" data-ref="crud" style="padding-bottom: 30px;">

            <div class="tab-content" style="margin-bottom: 20px;padding-bottom: 20px">
                <!-- 基本信息 -->
                <div class="tab-pane active" id="tab-basic" style="border-bottom:none;">
                    <div class="form-group">
                        <label for="table_name" class="col-sm-3 control-label is-required" >数据表</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" name="table_name"   id="table_name" required>
                                <option value="">请选择</option>
                                <?php if(is_array($tables) || $tables instanceof \think\Collection || $tables instanceof \think\Paginator): $i = 0; $__LIST__ = $tables;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <option value="<?php echo htmlentities((string) $vo); ?>"><?php echo htmlentities((string) $vo); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
<!--                    <div class="form-group node-content" >-->
<!--                        <label for="table_title" class="col-sm-3 control-label is-required" >表名称</label>-->
<!--                        <div class="col-sm-8">-->
<!--                            <input  type="text" id="table_title" class="form-control" placeholder="请输入表名称" name="table_title"  required/>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="app_name" class="col-sm-3 control-label is-required" >选择应用</label>
                        <div class="col-sm-8">
                            <select class="form-control select2"  name="app_name"   id="app_name" required>
<!--                                <option value="">请选择</option>-->
                                <option value="admin">admin</option>
                                <option value="api">api</option>
                                <option value="merchant">merchant</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label" >生成视图</label>
                        <div class="col-sm-8">
                            <div class="radio-box">
                                <input type="radio" id="view_1" name="is_view" value="1" checked>
                                <label for="view_1" >是</label>
                            </div>
                            <div class="radio-box">
                                <input type="radio" id="view_0" name="is_view" value="0" >
                                <label for="view_0" >否</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-3 control-label" >创建菜单</label>
                        <div class="col-sm-8">
                            <div class="radio-box" id="is_node_1">
                                <input type="radio" id="node_1" name="is_node" value="1" checked />
                                <label for="node_1" >是</label>
                            </div>
                            <div class="radio-box">
                                <input type="radio" id="node_0" name="is_node" value="0" />
                                <label for="node_0" >否</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group node-content">
                        <label  class="col-sm-3 control-label" >创建菜单</label>
                        <div class="col-sm-8">
                            <select class="form-control select2"  name="node[parent_id]"   id="node_parent">
                                <option value="">请选择</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group node-content" >
                        <label for="node_title" class="col-sm-3 control-label is-required" >菜单名称</label>
                        <div class="col-sm-8">
                            <input  type="text" id="node_title" class="form-control" placeholder="请输入菜单名称" name="node[title]"  />
                        </div>
                    </div>
                    <div class="form-group node-content" >
                        <label for="node_sort" class="col-sm-3 control-label is-required" >菜单排序</label>
                        <div class="col-sm-8">
                            <input  type="text" id="node_sort" class="form-control" placeholder="请输入菜单名称" name="node[sort]"  />
                        </div>
                    </div>

                </div>

                <!-- 字段信息 -->
                <div class="tab-pane" id="tab-field" >
                    <div class="col-sm-12 select-table table-striped" style="padding-bottom: 30px;min-height: 100px;">
                        <table id="boot-table"></table>
                    </div>
                </div>

                <div class="ibox-content" style="margin-top: 20px !important;">
                    <div class="col-sm-offset-5 col-sm-6">
                        <button type="button" class="btn btn-sm btn-primary" onclick="submitHandler()"><i class="fa fa-check"></i>保 存</button>&nbsp;
                        <button type="button" class="btn btn-sm btn-danger" onclick="closeItem()"><i class="fa fa-reply-all"></i>关 闭 </button>
                    </div>
                </div>

            </div>
            <select id="dict_list" style="display: none"></select>
        </form>



    </div>



</div>
<script type="text/javascript">
    var ctx = "/<?php echo env('hr.admin'); ?>";
    var lockscreen = null; if(lockscreen){window.top.location=ctx+"lockscreen";}
</script>
<a id="scroll-up" href="#" class="btn btn-sm display"><i class="fa fa-angle-double-up"></i></a>
<script src="/static/js/jquery.min.js?v=3.6.0"></script>
<script src="/static/js/bootstrap.min.js?v=3.3.7"></script>
<!-- bootstrap-table 表格插件 -->
<script src="/static/ajax/libs/bootstrap-table/bootstrap-table.min.js?v=1.18.3"></script>
<script src="/static/ajax/libs/bootstrap-table/locale/bootstrap-table-zh-CN.min.js?v=1.18.3"></script>
<script src="/static/ajax/libs/bootstrap-table/extensions/mobile/bootstrap-table-mobile.js?v=1.18.3"></script>
<!-- jquery-validate 表单验证插件 -->
<script src="/static/ajax/libs/validate/jquery.validate.min.js?v=1.19.3"></script>
<script src="/static/ajax/libs/validate/jquery.validate.extend.js?v=1.19.3"></script>
<script src="/static/ajax/libs/validate/messages_zh.js?v=1.19.3}"></script>
<!-- bootstrap-table 表格树插件 -->
<script src="/static/ajax/libs/bootstrap-table/extensions/tree/bootstrap-table-tree.min.js?v=1.18.3"></script>
<script src="/static/ajax/libs/bootstrap-table/extensions/columns/bootstrap-table-fixed-columns.js?v=1.18.3"></script>
<!-- 遮罩层 -->
<script src="/static/ajax/libs/blockUI/jquery.blockUI.js?v=2.70.0"></script>
<script src="/static/ajax/libs/iCheck/icheck.min.js?v=1.0.3"></script>
<script src="/static/ajax/libs/layer/layer.min.js?v=3.5.1"></script>
<script src="/static/ajax/libs/layui/layui.min.js?v=2.6.8"></script>
<script src="/static/ruoyi/js/common.js?v=4.7.4"></script>
<script src="/static/ruoyi/js/ry-ui.js?v=4.7.4"></script>
<!--富文本编辑器-->
<script src="/static/ajax/libs/summernote/summernote.js"></script>
<script src="/static/ajax/libs/summernote/summernote-zh-CN.js"></script>

<script src="/static/ajax/libs/select2/select2.min.js?v=4.0.13"></script>

<!--fancybox 图片浏览 -->

<link rel="stylesheet" type="text/css" href="/static/ajax/libs/fancybox/jquery.fancybox.css" />
<script type="text/javascript" src="/static/ajax/libs/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/static/ajax/libs/fancybox/jquery.mousewheel.pack.js"></script>
<script>
    $("body").removeClass("gray-bg").addClass("white-bg");
    function submitHandler() {
        if ($.validate.form()) {
            save();
        }
    }

    function save(){
        let form = $("#hr-form");
        let url = form.data("url") || ctx + "/" + form.data("ref") + "/save";
        $.ajax({
            cache : true,
            type : "POST",
            url : url,
            data : form.serializeObject(),
            async : false,
            error : function(request) {
                $.modal.alertError("系统错误");
            },
            success : function(data) {
                $.operate.successCallback(data);
            }
        });
    }
</script>

<script>

    // function submitHandler() {
    //     console.log($("#gen-form").serializeArray());
    //     // $.operate.saveTab("admin/crud/save", $("#gen-form").serializeArray());
    // }
    $(function() {
        var options = {
            url:  ctx + "/crud/getTable",
            modalName: "表信息",
            uniqueId:"field",
            pagination:false,
            firstLoad:false,
            showSearch: false,
            showRefresh: false,
            showColumns: false,
            showToggle: false,
            columns:[
                // {checkbox:true},
                {field:"field",title:"字段名称"},
                {field:"type",title:"字段类型"},
                {field:"comment",title:"字段描述",formatter:function (value,row){
                    // if (row.field === "deleted") return "";
                    if (value === "") {
                        value = row.field;
                    }
                    return '<input value="'+value+'" class="form-control" name="comment['+row.field+']"/>';
                }},
                {field:"field",title:"查询",formatter:function (value,row){
                    if (value === "id" || value === "deleted") return "";
                    return '<label class="check-box"><input type="checkbox" value="'+value+'"  name="search[]"/></label>';
                }},
                {field:"field",title:"必填",formatter:function (value,row){
                    if (value === "id" || value === "deleted") return "";
                    return '<label class="check-box"><input type="checkbox" value="'+value+'"  name="require[]"/></label>';
                }},
                {field:"field",title:"显示类型",width:'200',formatter:function (value,row){
                    if (value === "id" || value === "deleted") return "";
                        return '<select name="form_type['+value+']" class="form-control select2">'+
                            '<option value="input">文本框</option>'+
                            '<option value="select">下拉框</option>'+
                            '<option value="radio">单选框</option>'+
                            '<option value="checkbox">复选框</option>'+
                            '<option value="textarea">文本域</option>'+
                            '<option value="date">日期控件</option>'+
                            '<option value="upload">上传控件</option>'+
                            '<option value="summernote">富文本</option>'+
                            '<option value="no">否</option>'+
                            '</select>';
                    }},
                {field:"field",title:"字典",width:'200',formatter(value,row){
                    if (value === "id" || value === "deleted") return "";
                        return '<select name="dict['+value+']" class="form-control select2 dict-select">'+
                            '</select>';
                }},

            ],
            queryParams:function () {
                return {"tableName":$("#table_name").val()}
            },
            onPostBody:function (){
                $(".select2").select2();
                $(".dict-select").html($("#dict_list").html())
            }
        };
        $.table.init(options);
        $("#table_name").change(function (){
            let name = $(this).val();
            if (name){
                $.table.refresh();
            }
        });

        $("#app_name").change(function (){
            $("#node_parent").ajaxSelect({
                url:ctx + "/ajax/node?app_type="+$(this).val(),
                field:"title"
            });
        });

        $("#node_parent").ajaxSelect({
            url:ctx + "/ajax/node?app_type="+$("#app_name").val(),
            field:"title"
        });
        $("#dict_list").ajaxSelect({
            url:ctx + "/dictType/all",
            field:"dict_name",
            key:"dict_type",
            defaultText:"",
        });
        $("input[name='is_node']").change(function (){
            if ($(this).is(":checked") && $(this).val() == 1){
                $(".node-content").show();
                $("#node_parent").ajaxSelect({
                    url:ctx + "/ajax/node?app_type="+$("#app_name").val(),
                    field:"title"
                });
            }else{
                $("#node_parent").html("<option value=''>==请选择==</option>");
                $(".node-content").hide();
            }
        });

    });
</script>



</body>
</html>