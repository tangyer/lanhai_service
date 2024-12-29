<?php /*a:3:{s:67:"D:\dev\www\LanHaiService\app\merchant\view\merchant_user\index.html";i:1735023829;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
<div class="container-div">
    <div class="row">
        <div class="col-sm-12 search-collapse">
            <form id="role-form">
                <div class="select-list">
                    <ul>

                        <li>
                             登入账号
                                  <input type="text"  name="username"  id="username">
                        </li>
                        <li>
                             状态
                             <select class=" select2" id="status"  name="status"  >
                                  <option value="">请选择</option>
                                <?php $_result=get_dict('sys_normal_disable');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dict): $mod = ($i % 2 );++$i;?>
                                    <option  value="<?php echo htmlentities((string) $dict['dict_value']); ?>" ><?php echo htmlentities((string) $dict['dict_label']); ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                        </li>

                        <li>
                            <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
                            <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

<!--        <div class="btn-group-sm" id="toolbar" role="group">-->
<!--            <a class="btn btn-success" onclick="$.operate.add()" >-->
<!--                <i class="fa fa-plus"></i> 新增-->
<!--            </a>-->
<!--            <a class="btn btn-primary single disabled" onclick="$.operate.edit()" >-->
<!--                <i class="fa fa-edit"></i> 修改-->
<!--            </a>-->
<!--            <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">-->
<!--                <i class="fa fa-remove"></i> 删除-->
<!--            </a>-->
<!--        </div>-->

        <div class="col-sm-12 select-table table-striped">
            <table id="boot-table"></table>
        </div>
    </div>
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
    
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/merchantUser";
var sysNormalDisable = JSON.parse('<?php echo get_dict("sys_normal_disable",true); ?>') ;

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "merchantUser",
        uniqueId:"id",
        columns:[
            {checkbox:true},
            {field:"username",title:"登入账号" },
            {field:"last_login_time",title:"最后登录时间" },
            {field:"last_login_ip",title:"最后登录IP" },
            {field:"fail_times",title:"登录失败次数" },
            {field:"status",title:"状态" ,formatter:function (value){
                    return $.table.selectDictLabel(sysNormalDisable,value)
                }},
            {field:"create_time",title:"创建时间" }
        ],
    };
    $.table.init(options);
});

</script>







</body>
</html>