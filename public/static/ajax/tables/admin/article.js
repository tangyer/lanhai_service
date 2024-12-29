
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/article";
$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "文章",
        uniqueId:"id",
        columns:[
              {checkbox:true},
            {field:"cate_id",title:"文章分类"},
            {field:"title",title:"文章标题"},
            {field:"image",title:"图片",formatter:function (value){
                return "<img src='"+value+"' width='50'>";
            }},
            {field:"sort",title:"排序"},
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
/* 状态显示 */
function statusTools(row) {
    if (row.status == 0) {
        return '<i class=\"fa fa-toggle-off text-info fa-2x\" onclick="enable(\'' + row.id + '\')"></i> ';
    } else {
        return '<i class=\"fa fa-toggle-on text-info fa-2x\" onclick="disable(\'' + row.id + '\')"></i> ';
    }
}

/* 管理-停用 */
function disable(id) {
    $.modal.confirm("确认要不显示该文章吗？", function() {
        $.operate.post(prefix + "/changeStatus" , { "id": id, "status": 0 });
    })
}

/* 管理启用 */
function enable(id) {
    $.modal.confirm("确认要显示该文章吗？", function() {
        $.operate.post(prefix + "/changeStatus", { "id": id, "status": 1 });
    })
}