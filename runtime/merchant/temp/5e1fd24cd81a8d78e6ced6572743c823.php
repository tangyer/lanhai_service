<?php /*a:3:{s:65:"D:\dev\www\LanHaiService\app\merchant\view\work_order\detail.html";i:1735196419;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
<section class="main-content">
    <div class="panel panel-primary panel-intro">
<!--        <div class="panel-heading">-->
<!--            详细信息-->
<!--        </div>-->
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label" >工单编号</label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext"><?php echo htmlentities((string) $model['order_code']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >激活码</label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext"><?php echo htmlentities((string) $model['active_code']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >工单名称</label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext"><?php echo htmlentities((string) $model['order_name']); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >工单类型</label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext"><?php echo htmlentities((string) $model['platform']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >
                                <i class="fa fa-info-circle"  data-toggle="tooltip" title="总端口数 / 使用端口 / 在线端口"></i>
                                端口数
                            </label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext">
                                    <?php echo htmlentities((string) $model['port_num']); ?> /
                                    <?php echo htmlentities((string) $model['port_use_num']); ?> /
                                    <?php echo htmlentities((string) $model['port_online_num']); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >
                                <i class="fa fa-info-circle"  data-toggle="tooltip" title="进粉总数 / 重复粉数 / 当日进粉数"></i>
                                进粉总数
                            </label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext">
                                    <?php echo htmlentities((string) $model['fans_num']); ?> /
                                    <?php echo htmlentities((string) $model['fans_repeat_num']); ?> /
                                    <?php echo htmlentities((string) $model['today_fans_num']); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >清零时间</label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext"><?php echo htmlentities((string) $model['clean_time']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group row">
                            <label class="col-sm-5 control-label " >状态</label>
                            <div class="col-sm-7">
                                <p class="form-control-plaintext"><?php echo get_dict_label('sys_normal_disable',$model['status']); ?></p>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>

    </div>
    <!--        table-striped table thead  ry-ui.css  871 行-->
    <!--        帐号数据-->
    <div class="btn-group-sm" id="toolbar" role="group">
        <a class="btn btn-success" onclick="viewWorkOrderBranch('<?php echo htmlentities((string) $model['order_code']); ?>')" >
            <i class="fa fa-list"></i> 分流连接
        </a>
        <a class="btn btn-info" onclick="viewWorkOrderFans('<?php echo htmlentities((string) $model['order_code']); ?>')" >
            <i class="fa fa-user"></i> 粉丝数据
        </a>

    </div>

    <div class="col-sm-12 select-table table-striped">
        <table id="boot-table"></table>
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
   $(function () {
       $("[data-toggle='tooltip']").tooltip();
   });
</script>
<script>

    var editFlag = "";
    var removeFlag = "";
    var prefix = ctx + "/workOrderAccount";
    var sysOnlineStatus = JSON.parse('<?php echo get_dict("sys_online_status",true); ?>') ;
    var sysPortStatus = JSON.parse('<?php echo get_dict("sys_port_status",true); ?>') ;

    $(function() {
        var options = {
            url: prefix + "/index",
            createUrl: prefix + "/create",
            updateUrl: prefix + "/update?id={id}",
            removeUrl: prefix + "/delete",
            exportUrl: prefix + "/export",
            sortName: "id",
            modalName: "workOrderAccount",
            uniqueId:"id",
            columns:[
                {checkbox:true},
                {field:"account_name",title:"账户名称" },
                {field:"mobile",title:"手机号" },
                {field:"account_id",title:"账户ID" },
                {field:"online_status",title:"在线状态" ,formatter:function (value){
                        return $.table.selectDictLabel(sysOnlineStatus,value)
                    }},
                {field:"port_status",title:"端口状态" ,formatter:function (value){
                        return $.table.selectDictLabel(sysPortStatus,value)
                }},
                // {field:"fans_target_num",title:"目标总数" },
                {field:"today_fans_repeat_num",title:"当日重粉 / 总重粉",formatter:function (value,row){
                        return value + " / " + row.fans_repeat_num
                    }  },
                {field:"today_fans_num",title:"当日进粉数 / 进粉总数",formatter:function (value,row){
                    return value + " / " + row.fans_num
                } },
                // {field:"today_fans_target_num",title:"当日进粉目标" },
                {field:"online_time",title:"上线时间" },
                {field:"offline_time",title:"下线时间" },
                {field:"account_link",title:"主号连接" },
                {
                    title: '操作',
                    width: '10',
                    widthUnit: '%',
                    align: "left",
                    formatter: function(value, row, index) {
                        var actions = [];
                        actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-trash"></i>删除</a>');
                        return actions.join('');
                    }
                }
            ],
        };
        $.table.init(options);
    });

    function viewWorkOrderBranch(orderCode){
        $.modal.popupRight( "分流连接", ctx + "/workOrderBranch/detail?order_code=<?php echo htmlentities((string) $model['order_code']); ?>");
    }
    
    function viewWorkOrderFans(orderCode) {
        $.modal.openTab( "粉丝数据", ctx + "/workOrder/fansList?order_code=<?php echo htmlentities((string) $model['order_code']); ?>");
    }

</script>


</body>
</html>