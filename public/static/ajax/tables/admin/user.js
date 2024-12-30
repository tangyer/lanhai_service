
var editFlag = "";
var removeFlag = "";
var resetPwdFlag = "";
var prefix = ctx + "/user";

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "用户",
        uniqueId:"id",
        columns:[
            {checkbox:true},
            {field:"username",title:"登入账号"},
            {field:"realname",title:"真实姓名"},
            {field:"mobile",title:"电话"},
            {field:"role_name",title:"角色"},
            {field:"last_login_time",title:"最后登录时间"},
            {field:"last_login_ip",title:"最后登录IP"},
            {field:"fail_times",title:"登录失败次数"},
            {
                title: '状态',
                align: 'center',
                formatter: function (value, row, index) {
                    return statusTools(row);
                }
            },
            {field:"create_time",title:"创建时间"},
            {
                title: '操作',
                width: '20',
                widthUnit: '%',
                align: "left",
                formatter: function(value, row, index) {
                    if (row.id === 1){
                        return  "-";
                    }
                    var actions = [];
                    actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                    actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-trash"></i>删除</a>');
                    var more = [];
                    more.push("<a class='btn btn-default btn-xs " + resetPwdFlag + "' href='javascript:void(0)' onclick='resetPwd(" + row.id + ")'><i class='fa fa-key'></i>重置密码</a> ");
                    actions.push(' <a tabindex="0" class="btn btn-info btn-xs" role="button" data-container="body" data-placement="left" data-toggle="popover" data-html="true" data-trigger="hover" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');
                    return actions.join('');
                }
            }
        ],
    };
    $.table.init(options);
});
/* 用户状态显示 */
function statusTools(row) {
    if (row.status == 0) {
        return '<i class=\"fa fa-toggle-off text-info fa-2x\" onclick="enable(\'' + row.id + '\')"></i> ';
    } else {
        return '<i class=\"fa fa-toggle-on text-info fa-2x\" onclick="disable(\'' + row.id + '\')"></i> ';
    }
}

/* 用户管理-停用 */
function disable(id) {
    $.modal.confirm("确认要停用用户吗？", function() {
        $.operate.post(prefix + "/changeStatus" , { "id": id, "status": 0 });
    })
}

/* 用户管理启用 */
function enable(id) {
    $.modal.confirm("确认要启用用户吗？", function() {
        $.operate.post(prefix + "/changeStatus", { "id": id, "status": 1 });
    })
}

/* 用户管理-重置密码 */
function resetPwd(userId) {
    var url = prefix + '/resetPwd?id=' + userId;
    $.modal.open("重置密码", url, '800', '300');
}