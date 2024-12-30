
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/config";

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "sort",
        modalName: "配置",
        uniqueId:"id",
        columns:[
            {checkbox:true},
            {field:"title",title:"配置标题"},
            {field:"name",title:"名称"},
            {field:"value",title:"配置值"},
            {field:"sort",title:"排序",sortable: true},
            {field:"group",title:"分组"},
            {field:"description",title:"配置说明"},
            {
                title: '状态',
                align: 'center',
                formatter: function (value, row, index) {
                    return statusTools(row);
                }
            },
            {
                title: '操作',
                width: '20',
                widthUnit: '%',
                align: "left",
                formatter: function(value, row, index) {
                    var actions = [];
                    actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                    // actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-trash"></i>删除</a>');
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
    $.modal.confirm("确认要停用该配置吗？", function() {
        $.operate.post(prefix + "/changeStatus" , { "id": id, "status": 0 });
    })
}

/* 用户管理启用 */
function enable(id) {
    $.modal.confirm("确认要启用配置吗？", function() {
        $.operate.post(prefix + "/changeStatus", { "id": id, "status": 1 });
    })
}