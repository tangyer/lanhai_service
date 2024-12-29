var addFlag = "";
var editFlag = "";
var removeFlag = "";
var datas = [
    {dictValue:1,listClass:"primary",dictLabel:"显示"},
    {dictValue:0,listClass:"danger",dictLabel:"隐藏"},
];
var prefix = ctx + "/node";

$(function() {
    var options = {
        code: "id",
        parentCode: "parent_id",
        uniqueId: "id",
        expandAll: false,
        expandFirst: false,
        url: prefix + "/index",
        createUrl: prefix + "/create?app_type={id}",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        modalName: "节点",
        // ajaxParams:$("#node-form").serializeObject(),
        columns: [{
            field: '',
            radio: true
            },
            {
                title: '节点名称',
                field: 'title',
                width: '25',
                widthUnit: '%',
                formatter: function(value, row, index) {
                    if ($.common.isEmpty(row.icon)) {
                        return row.title;
                    } else {
                        return '<i class="' + row.icon + '"></i> <span class="nav-label">' + row.title + '</span>';
                    }
                }
            },
            {
                title: '所属',
                field: 'app_type',
                width: '10',
                widthUnit: '%',
                align: "left"
            },
            {
                field: 'sort',
                title: '排序',
                width: '10',
                widthUnit: '%',
                align: "left"
            },
            {
                field: 'url',
                title: '请求地址',
                width: '25',
                widthUnit: '%',
                align: "left",
                formatter: function(value, row, index) {
                    return $.table.tooltip(value);
                }
            },
            {
                title: '类型',
                field: 'type',
                width: '10',
                widthUnit: '%',
                align: "left",
                formatter: function(value, item, index) {
                    if (item.type == 2) {
                        return '<span class="label label-success">目录</span>';
                    }
                    else if (item.type == 1) {
                        return '<span class="label label-primary">菜单</span>';
                    }
                    else if (item.type == 3) {
                        return '<span class="label label-warning">按钮</span>';
                    }
                }
            },
            {
                field: 'status',
                title: '可见',
                width: '10',
                widthUnit: '%',
                align: "left",
                formatter: function(value, row, index) {
                    if (row.type == 3) {
                        return '-';
                    }
                    return $.table.selectDictLabel(datas, row.status);
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
                    actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-trash"></i>删除</a>');
                    return actions.join('');
                }
            }]
    };
    $.treeTable.init(options);
});