<?php /*a:3:{s:72:"D:\dev\www\LanHaiService\app\merchant\view\work_order_branch\create.html";i:1735138250;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
<div class="wrapper wrapper-content animated fadeInRight ">
    <form class="form-horizontal m" id="hr-form" data-ref="workOrderBranch">
        <div class="form-group">
           <label  class="col-sm-3 control-label is-required" >工单编号</label>
            <div class="col-sm-8">
                <input  type="text" id="order_code" class="form-control "  name="order_code"  value="<?php echo htmlentities((string) $order_code); ?>" readonly />
            </div>
        </div>
        <div class="form-group">
           <label  class="col-sm-3 control-label is-required" >短链平台</label>
            <div class="col-sm-8">
               <?php $_result=get_dict('sys_link_type');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dict): $mod = ($i % 2 );++$i;?>
                <div class="radio-box">
                    <input type="radio" id="link_type_<?php echo htmlentities((string) $dict['dict_value']); ?>" name="link_type" value="<?php echo htmlentities((string) $dict['dict_value']); ?>" <?php echo $dict['is_default']==1 ? "checked"  :  ""; ?>>
                    <label for="link_type_<?php echo htmlentities((string) $dict['dict_value']); ?>" ><?php echo htmlentities((string) $dict['dict_label']); ?></label>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="form-group" id="short_link_input" style="display: none;">
           <label  class="col-sm-3 control-label is-required" >短链接 </label>
            <div class="col-sm-8">
               <input  type="text" id="short_link" class="form-control " placeholder="请输入短链接" name="short_link" />
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-3 control-label is-required" >分配模式</label>
            <div class="col-sm-8">
                <div class="radio-box">
                    <input type="radio" id="branch_type"  value="online" checked>
                    <label for="branch_type" >分配在线帐号</label>
                </div>
            </div>
        </div>
        <div class="form-group">
           <label  class="col-sm-3 control-label is-required" >状态</label>
            <div class="col-sm-8">
               <?php $_result=get_dict('sys_normal_disable');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dict): $mod = ($i % 2 );++$i;?>
                <div class="radio-box">
                    <input type="radio" id="status_<?php echo htmlentities((string) $dict['dict_value']); ?>" name="status" value="<?php echo htmlentities((string) $dict['dict_value']); ?>" <?php echo $dict['is_default']==1 ? "checked"  :  ""; ?>>
                    <label for="status_<?php echo htmlentities((string) $dict['dict_value']); ?>" ><?php echo htmlentities((string) $dict['dict_label']); ?></label>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="form-group" style="margin-top: 20px !important;">
            <div class="col-sm-offset-5 col-sm-6">
                <button type="button" class="btn btn-sm btn-primary" onclick="submitOrder()"><i class="fa fa-check"></i>保 存</button>&nbsp;
                <button type="button" class="btn btn-sm btn-danger" onclick="closeModal()"><i class="fa fa-reply-all"></i>关 闭 </button>
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
    $("input[name='link_type']").on('ifChecked', function(obj){
        let val = $(this).val();
        if (val === "customize"){
            $("#short_link_input").show();
        }else{
            $("#short_link_input").hide();
        }

    })
    function submitOrder() {
        if ($.validate.form()) {
            $.ajax({
                cache : true,
                type : "POST",
                url : ctx + "/workOrderBranch/save",
                data : $("#hr-form").serializeObject(),
                async : false,
                error : function(request) {
                    $.modal.alertError("系统错误");
                },
                success : function(result) {
                    if (result.code == web_status.SUCCESS) {
                        $.modal.msgSuccess("保存成成功");
                        location.href = ctx + "/workOrderBranch/detail?order_code=<?php echo htmlentities((string) $order_code); ?>";
                    }else{
                        $.modal.alertError("系统错误");
                    }
                }
            });
        }
    }
    function closeModal(){
        $.modal.close()
    }
</script>



</body>
</html>