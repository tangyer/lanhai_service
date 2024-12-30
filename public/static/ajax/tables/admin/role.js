
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/role";

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "角色",
        columns: [{
            checkbox: true
        },
            {
                field: 'id',
                title: '角色编号'
            },
            {
                field: 'role_name',
                title: '角色名称',
                sortable: true
            },
            {
                field: 'description',
                title: '备注',
            },
            {
                visible: editFlag == 'hidden' ? false : true,
                title: '状态',
                align: 'center',
                formatter: function (value, row, index) {
                    return statusTools(row);
                }
            },
            {
                title: '操作',
                align: 'center',
                formatter: function(value, row, index) {
                    if (row.roleId != 1) {
                        var actions = [];
                        actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                        // var more = [];
                        // more.push("<a class='btn btn-default btn-xs " + editFlag + "' href='javascript:void(0)' onclick='authDataScope(" + row.roleId + ")'><i class='fa fa-check-square-o'></i>数据权限</a> ");
                        // more.push("<a class='btn btn-default btn-xs " + editFlag + "' href='javascript:void(0)' onclick='authUser(" + row.roleId + ")'><i class='fa fa-user'></i>分配用户</a>");
                        // actions.push('<a tabindex="0" class="btn btn-info btn-xs" role="button" data-container="body" data-placement="left" data-toggle="popover" data-html="true" data-trigger="hover" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');
                        return actions.join('');
                    } else {
                        return "";
                    }
                }
            }]
    };
    $.table.init(options);
});

/* 角色管理-分配数据权限 */
function authDataScope(roleId) {
    var url = prefix + '/authDataScope/' + roleId;
    $.modal.open("分配数据权限", url);
}

/* 角色管理-分配用户 */
function authUser(roleId) {
    var url = prefix + '/authUser/' + roleId;
    $.modal.openTab("分配用户", url);
}

/* 角色状态显示 */
function statusTools(row) {
    if (row.status == 0) {
        return '<i class=\"fa fa-toggle-off text-info fa-2x\" onclick="enable(\'' + row.id + '\')"></i> ';
    } else {
        return '<i class=\"fa fa-toggle-on text-info fa-2x\" onclick="disable(\'' + row.id + '\')"></i> ';
    }
}

/* 角色管理-停用 */
function disable(roleId) {
    $.modal.confirm("确认要停用角色吗？", function() {
        $.operate.post(prefix + "/changeStatus" , { "id": roleId, "status": 0 });
    })
}

/* 角色管理启用 */
function enable(roleId) {
    $.modal.confirm("确认要启用角色吗？", function() {
        $.operate.post(prefix + "/changeStatus", { "id": roleId, "status": 1 });
    })
}