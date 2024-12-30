
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/workOrderAccount";

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
            {field:"order_code",title:"工单编号"},
            {field:"account_name",title:"账户"},
            {field:"mobile",title:"手机号"},
            {field:"account_id",title:"账户ID"},
            {field:"online_status",title:"在线状态"},
            {field:"port_status",title:"端口状态"},
            {field:"fans_target_number",title:"目标总数"},
            {field:"fans_number",title:"进粉总数"},
            {field:"today_fans_repeat_number",title:"当日重复粉数"},
            {field:"fans_repeat_number",title:"重复粉数"},
            {field:"today_fans_number",title:"当日进粉数"},
            {field:"today_fans_target_number",title:"当日进粉目标"},
            {field:"online_time",title:"上线时间"},
            {field:"offline_time",title:"下线时间"},
            {field:"account_link",title:"主号连接"},

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
