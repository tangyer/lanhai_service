<?php /*a:4:{s:66:"D:\dev\www\LanHaiService\app\merchant\view\active_code\update.html";i:1735098811;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:59:"D:\dev\www\LanHaiService\app\merchant\view\public\form.html";i:1735097016;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
  <link href="/static/css/style.css?v=2021083111" rel="stylesheet"/>
  <link href="/static/ruoyi/css/ry-ui.css?v=4.7.4" rel="stylesheet"/>
  <!--富文本编辑器-->
  <link href="/static/ajax/libs/summernote/summernote.css" rel="stylesheet"/>
  <link href="/static/ajax/libs/select2/select2.min.css?v=4.0.13" rel="stylesheet"/>
  <link href="/static/ajax/libs/select2/select2-bootstrap.min.css?v=4.0.13" rel="stylesheet"/>
</head>
<body>

<!-- ./ preloader -->
<div class="wrapper wrapper-content animated fadeInRight ibox-content">
    <form class="form-horizontal m" id="hr-form" data-ref="activeCode">
        <input  type="hidden" name="id" value="<?php echo htmlentities((string) $model['id']); ?>"/>
            <div class="form-group">
               <label  class="col-sm-3 control-label is-required" >激活码</label>
                <div class="col-sm-8">
                   <input  type="text" id="active_code" class="form-control " placeholder="请输入激活码" name="active_code" value="<?php echo htmlentities((string) $model['active_code']); ?>" readonly />
                </div>
            </div>
            <div class="form-group">
                <label  class="col-sm-3 control-label is-required" >所属分组</label>
                <div class="col-sm-8">
                    <select class="form-control select2" name="active_code_group_id" data-url="<?php echo url('activeCodeGroup/all'); ?>" data-value="<?php echo htmlentities((string) $model['active_code_group_id']); ?>" data-toggle="select" data-field="group_name" ></select>
                </div>
            </div>
            <div class="form-group">
               <label  class="col-sm-3 control-label is-required" >分配端口</label>
                <div class="col-sm-8">
                   <input  type="text" id="port_num" class="form-control" placeholder="请输入分配端口" name="port_num" value="<?php echo htmlentities((string) $model['port_num']); ?>" required />
                </div>
            </div>
            <div class="form-group">
               <label  class="col-sm-3 control-label is-required" >失效时间</label>
                <div class="col-sm-8">
                   <input  type="text" id="expire_time" class="form-control time-input" data-type="datetime" data-format="yyyy-MM-dd HH:mm"  placeholder="请输入失效时间" name="expire_time" value="<?php echo htmlentities((string) get_time($model['expire_time'])); ?>" required />
                </div>
            </div>
                <div class="form-group">
                    <label  class="col-sm-3 control-label is-required" >清零时间</label>
                    <div class="col-sm-8">
                        <input  type="text" id="clean_time" class="form-control time-input" data-type="time" value="<?php echo htmlentities((string) $model['clean_time']); ?>" placeholder="请输入清零时间 默认 10:00" name="clean_time"  required />
                    </div>
                </div>
            <div class="form-group">
               <label  class="col-sm-3 control-label is-required" >使用平台</label>
                <div class="col-sm-8">
                    <?php if(is_array($platform) || $platform instanceof \think\Collection || $platform instanceof \think\Paginator): $i = 0; $__LIST__ = $platform;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$platform): $mod = ($i % 2 );++$i;?>
                    <label  class="check-box">
                        <input type="checkbox" id="platform_<?php echo htmlentities((string) $platform); ?>" name="platform[]" value="<?php echo htmlentities((string) $platform); ?>" checked >
                        <?php echo htmlentities((string) $platform); ?>
                    </label>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <div class="form-group">
               <label  class="col-sm-3 control-label " >备注</label>
                <div class="col-sm-8">
                   <textarea rows="5"  id="remark" class="form-control " placeholder="请输入备注" name="remark"  ><?php echo htmlentities((string) $model['remark']); ?></textarea>
                </div>
            </div>
            <div class="form-group">
               <label  class="col-sm-3 control-label " >说明</label>
                <div class="col-sm-8">
                   <textarea rows="5"  id="content" class="form-control " placeholder="请输入说明" name="content"  ><?php echo htmlentities((string) $model['content']); ?></textarea>
                </div>
            </div>
            <div class="form-group">
               <label  class="col-sm-3 control-label is-required" >状态</label>
                <div class="col-sm-8">
                   <?php $_result=get_dict('sys_normal_disable');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dict): $mod = ($i % 2 );++$i;?>
        <div class="radio-box">
            <input type="radio" id="status_<?php echo htmlentities((string) $dict['dict_value']); ?>" name="status" value="<?php echo htmlentities((string) $dict['dict_value']); ?>" <?php echo $dict['dict_value']==$model['status'] ? "checked"  :  ""; ?>>
            <label for="status_<?php echo htmlentities((string) $dict['dict_value']); ?>" ><?php echo htmlentities((string) $dict['dict_label']); ?></label>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>


    </form>
</div>
<script type="text/javascript">
    var ctx = "/<?php echo env('hr.merchant'); ?>";
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
    // $("body").removeClass("gray-bg").addClass("white-bg");
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