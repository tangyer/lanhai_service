<?php /*a:4:{s:73:"D:\dev\www\LanHaiService\app\merchant\view\work_order_account\create.html";i:1735108332;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:59:"D:\dev\www\LanHaiService\app\merchant\view\public\form.html";i:1735097016;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
    <form class="form-horizontal m" id="hr-form" data-ref="workOrderAccount">
             <div class="form-group">
       <label  class="col-sm-3 control-label is-required" >商户ID</label>
        <div class="col-sm-8">
           <input  type="text" id="merchant_id" class="form-control " placeholder="请输入商户ID" name="merchant_id"  required />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label is-required" >激活码</label>
        <div class="col-sm-8">
           <input  type="text" id="active_code" class="form-control " placeholder="请输入激活码" name="active_code"  required />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label is-required" >工单编号</label>
        <div class="col-sm-8">
           <input  type="text" id="order_code" class="form-control " placeholder="请输入工单编号" name="order_code"  required />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label is-required" >账户</label>
        <div class="col-sm-8">
           <input  type="text" id="account_name" class="form-control " placeholder="请输入账户" name="account_name"  required />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label is-required" >手机号</label>
        <div class="col-sm-8">
           <input  type="text" id="mobile" class="form-control " placeholder="请输入手机号" name="mobile"  required />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label is-required" >账户ID</label>
        <div class="col-sm-8">
           <input  type="text" id="account_id" class="form-control " placeholder="请输入账户ID" name="account_id"  required />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >在线状态</label>
        <div class="col-sm-8">
           <?php $_result=get_dict('sys_online_status');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dict): $mod = ($i % 2 );++$i;?>
<div class="radio-box">
    <input type="radio" id="online_status_<?php echo htmlentities((string) $dict['dict_value']); ?>" name="online_status" value="<?php echo htmlentities((string) $dict['dict_value']); ?>" <?php echo $dict['is_default']==1 ? "checked"  :  ""; ?>>
    <label for="online_status_<?php echo htmlentities((string) $dict['dict_value']); ?>" ><?php echo htmlentities((string) $dict['dict_label']); ?></label>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >端口状态</label>
        <div class="col-sm-8">
           <?php $_result=get_dict('sys_port_status');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dict): $mod = ($i % 2 );++$i;?>
<div class="radio-box">
    <input type="radio" id="port_status_<?php echo htmlentities((string) $dict['dict_value']); ?>" name="port_status" value="<?php echo htmlentities((string) $dict['dict_value']); ?>" <?php echo $dict['is_default']==1 ? "checked"  :  ""; ?>>
    <label for="port_status_<?php echo htmlentities((string) $dict['dict_value']); ?>" ><?php echo htmlentities((string) $dict['dict_label']); ?></label>
</div>
<?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >目标总数</label>
        <div class="col-sm-8">
           <input  type="text" id="fans_target_num" class="form-control " placeholder="请输入目标总数" name="fans_target_num"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >进粉总数</label>
        <div class="col-sm-8">
           <input  type="text" id="fans_num" class="form-control " placeholder="请输入进粉总数" name="fans_num"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >当日重复粉数</label>
        <div class="col-sm-8">
           <input  type="text" id="today_fans_repeat_num" class="form-control " placeholder="请输入当日重复粉数" name="today_fans_repeat_num"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >重复粉数</label>
        <div class="col-sm-8">
           <input  type="text" id="fans_repeat_num" class="form-control " placeholder="请输入重复粉数" name="fans_repeat_num"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >当日进粉数</label>
        <div class="col-sm-8">
           <input  type="text" id="today_fans_num" class="form-control " placeholder="请输入当日进粉数" name="today_fans_num"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >当日进粉目标</label>
        <div class="col-sm-8">
           <input  type="text" id="today_fans_target_num" class="form-control " placeholder="请输入当日进粉目标" name="today_fans_target_num"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >上线时间</label>
        <div class="col-sm-8">
           <input  type="text" id="online_time" class="form-control " placeholder="请输入上线时间" name="online_time"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >下线时间</label>
        <div class="col-sm-8">
           <input  type="text" id="offline_time" class="form-control " placeholder="请输入下线时间" name="offline_time"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >主号连接</label>
        <div class="col-sm-8">
           <input  type="text" id="account_link" class="form-control " placeholder="请输入主号连接" name="account_link"   />
        </div>
    </div>
    <div class="form-group">
       <label  class="col-sm-3 control-label " >用户token</label>
        <div class="col-sm-8">
           <input  type="text" id="token" class="form-control " placeholder="请输入用户token" name="token"   />
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