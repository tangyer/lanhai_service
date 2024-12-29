<?php /*a:4:{s:58:"D:\dev\www\LanHaiService\app\admin\view\config\create.html";i:1694898196;s:58:"D:\dev\www\LanHaiService\app\admin\view\layout\layout.html";i:1735125879;s:56:"D:\dev\www\LanHaiService\app\admin\view\public\form.html";i:1694898196;s:54:"D:\dev\www\LanHaiService\app\admin\view\public\js.html";i:1734774942;}*/ ?>
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
<div class="wrapper wrapper-content animated fadeInRight ibox-content">
    <form class="form-horizontal m" id="hr-form" data-ref="config">
         <div class="form-group">
       <label for="title" class="col-sm-3 control-label is-required" >配置标题</label>
       <div class="col-sm-8">
            <input  type="text" id="title" class="form-control" placeholder="请输入配置标题" name="title"  required/>
       </div>
    </div>
<div class="form-group">
       <label for="name" class="col-sm-3 control-label is-required" >名称</label>
       <div class="col-sm-8">
            <input  type="text" id="name" class="form-control" placeholder="请输入名称" name="name"  required/>
       </div>
    </div>
<div class="form-group">
       <label for="value" class="col-sm-3 control-label is-required" >配置值</label>
       <div class="col-sm-8">
            <input  type="text" id="value" class="form-control" placeholder="请输入配置值" name="value"  required/>
       </div>
    </div>
<div class="form-group">
       <label for="sort" class="col-sm-3 control-label is-required" >排序</label>
       <div class="col-sm-8">
            <input  type="text" id="sort" class="form-control" placeholder="请输入排序" name="sort"  required/>
       </div>
    </div>
<div class="form-group">
       <label for="group" class="col-sm-3 control-label is-required" >分组</label>
       <div class="col-sm-8">
            <input  type="text" id="group" class="form-control" placeholder="请输入分组" name="group"  required/>
       </div>
    </div>
<div class="form-group">
       <label for="description" class="col-sm-3 control-label is-required" >配置说明</label>
       <div class="col-sm-8">
            <input  type="text" id="description" class="form-control" placeholder="请输入配置说明" name="description"  required/>
       </div>
    </div>
<div class="form-group">
       <label for="status" class="col-sm-3 control-label is-required" >状态</label>
       <div class="col-sm-8">
            <input  type="text" id="status" class="form-control" placeholder="请输入状态" name="status"  required/>
       </div>
    </div>

    </form>
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




</body>
</html>