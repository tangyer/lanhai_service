<?php /*a:3:{s:64:"D:\dev\www\LanHaiService\app\merchant\view\work_order\index.html";i:1735200097;s:61:"D:\dev\www\LanHaiService\app\merchant\view\layout\layout.html";i:1735117447;s:57:"D:\dev\www\LanHaiService\app\merchant\view\public\js.html";i:1735013566;}*/ ?>
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
                             工单编号
                              <input type="text"  name="order_code"  id="order_code">
                        </li>
                        <li>
                             激活码
                              <input type="text"  name="active_code"  id="active_code" value="<?php echo isset($active_code) ? htmlentities((string) $active_code) : ''; ?>">
                        </li>
                        <li>
                             工单名称
                              <input type="text"  name="order_name"  id="order_name">
                        </li>
                        <li>
                             工单类型
                              <input type="text"  name="platform"  id="platform">
                        </li>

                        <li>
                            <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
                            <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

        <div class="btn-group-sm" id="toolbar" role="group">
<!--            <a class="btn btn-success" onclick="$.operate.add()" >-->
<!--                <i class="fa fa-plus"></i> 新增-->
<!--            </a>-->
<!--            <a class="btn btn-primary single disabled" onclick="$.operate.edit()" >-->
<!--                <i class="fa fa-edit"></i> 修改-->
<!--            </a>-->
        </div>

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
var prefix = ctx + "/workOrder";
var sysTransPlatform = JSON.parse('<?php echo get_dict("sys_trans_platform",true); ?>') ;
var sysNormalDisable = JSON.parse('<?php echo get_dict("sys_normal_disable",true); ?>') ;

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "工单",
        uniqueId:"id",
        columns:[
            {checkbox:true},
            {field:"order_code",title:"工单编号",formatter:function (value,row){
                    return '<a href="javascript:void(0)" onclick="detail(\'' + row.id + '\')">' + value + '</a>';
            } },
            {field:"active_code",title:"激活码" },
            {field:"order_name",title:"工单名称" },
            {field:"platform",title:"工单类型" ,formatter:function (value){
                return $.table.selectDictLabel(sysTransPlatform,value)
            }},
            {field:"port_num",title:"端口数" },
            {field:"port_use_num",title:"使用端口" },
            {field:"port_online_num",title:"在线端口" },
            {field:"fans_num",title:"进粉总数" },
            {field:"fans_repeat_num",title:"重复粉数" },
            {field:"today_fans_num",title:"当日进粉数" },
            {field:"clean_time",title:"清零时间" },
            {field:"status",title:"状态" ,formatter:function (value){
                    return $.table.selectDictLabel(sysNormalDisable,value)
                }},
            {field:"create_time",title:"创建时间" },

            {
                title: '操作',
                width: '20',
                widthUnit: '%',
                align: "left",
                formatter: function(value, row, index) {
                    var actions = [];
                    actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i> 编辑</a> ');
                    actions.push('<a class="btn btn-warning btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="shareOrder(\'' + row.order_code + '\')"><i class="fa fa-share-alt"></i> 分享</a>');
                    actions.push(' <a class="btn btn-primary btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="detail(\'' + row.id + '\')"><i class="fa fa-bars"></i> 详情</a>');
                    actions.push(' <a class="btn btn-info btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="resetOrder(\'' + row.id + '\')"><i class="fa fa-retweet"></i> 重置</a>');

                    // var more = [];
                    // more.push(" <a class='btn btn-danger btn-xs " + editFlag + "' href='javascript:void(0)' onclick='cancelShareOrder(" + row.order_code + ")'><i class='fa fa-remove'></i>取消分享</a> ");
                    // more.push(" <a class='btn btn-warning btn-xs " + editFlag + "' href='javascript:void(0)' onclick='resetOrder(" + row.order_code + ")'><i class='fa fa-pencil'></i>重置工单</a>");
                    // actions.push(' <a tabindex="0" class="btn btn-info btn-xs" role="button" data-container="body" data-placement="left" data-toggle="popover" data-html="true" data-trigger="hover" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');
                    return actions.join('');
                }
            }
        ],
    };
    $.table.init(options);
});

function shareOrder(code){
    $.modal.popupRight("分享工单", ctx + "/workOrderShare/index?order_code="+code);
}
function detail(id) {
    var url = ctx + '/workOrder/detail?id=' + id;
    $.modal.openTab("工单信息", url);
}

function resetOrder(id){
    $.modal.confirm("确定重置该工单吗？", function() {
        var url = ctx + "/workOrder/reset";
        var data = { "id": id };
        $.operate.submit(url, "post", "json", data);
    });
}

</script>







</body>
</html>