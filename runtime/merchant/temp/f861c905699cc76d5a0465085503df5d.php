<?php /*a:3:{s:72:"D:\dev\www\LanHaiService\app\merchant\view\work_order_branch\detail.html";i:1735177729;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
<!-- Main content -->
<section class="content">
     <div class="panel panel-primary panel-intro" style="width: 75%;margin: 0 auto" >
        <div class="panel-heading">
         详细信息
        </div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group row">
                    <label class="col-sm-3 control-label" >工单编号</label>
                    <div class="col-sm-6">
                        <p class="form-control-plaintext"><?php echo htmlentities((string) $model['order_code']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label" >短链平台</label>
                    <div class="col-sm-6">
                        <p class="form-control-plaintext"><?php echo htmlentities((string) $model['link_type']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label" >短链接</label>
                    <div class="col-sm-6">
                        <p class="form-control-plaintext"><?php echo htmlentities((string) $model['short_link']); ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label" >分配模式</label>
                    <div class="col-sm-6">
                        <p class="form-control-plaintext">分配在线帐号</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label" >点击数</label>
                    <div class="col-sm-6">
                        <p class="form-control-plaintext"><?php echo htmlentities((string) $model['click_num']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 control-label" >状态</label>
                    <div class="col-sm-6">
                        <p class="form-control-plaintext"><?php echo get_dict_label('sys_normal_disable',$model['status']); ?></p>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 20px !important;">
                    <div class="col-sm-offset-5 col-sm-6">
                        <a type="button" class="btn btn-sm btn-primary" href="<?php echo url('workOrderBranch/update',['id' => $model['id']]); ?>"><i class="fa fa-check"></i>编辑</a>&nbsp;
                        <button type="button" class="btn btn-sm btn-danger" onclick="closeModal()"><i class="fa fa-reply-all"></i>关 闭 </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</section>
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
    function closeModal(){
        $.modal.close()
    }
</script>

</body>
</html>