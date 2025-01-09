
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/workOrder";

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
            {field:"customer_id",title:"商户ID"},
            {field:"order_code",title:"工单编号"},
            {field:"active_code",title:"激活码"},
            {field:"order_name",title:"工单名称"},
            {field:"platform",title:"工单类型"},
            {field:"port_number",title:"帐号总数"},
            {field:"port_online_number",title:"在线帐号"},
            {field:"fans_target_number",title:"目标总数"},
            {field:"fans_number",title:"进粉总数"},
            {field:"fans_repeat_number",title:"重复粉数"},
            {field:"today_fans_number",title:"当日进粉数"},
            {field:"share_password",title:"分享密码"},
            {field:"share_expire_time",title:"失效时间"},
            {field:"clean_time",title:"清零时间"},
            {field:"reset_time",title:"重置时间"},
            {field:"status",title:"状态："},
            {field:"create_time",title:"创建时间"},

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
