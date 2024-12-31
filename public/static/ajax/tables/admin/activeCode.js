
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/activeCode";

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "activeCode",
        uniqueId:"id",
        columns:[
              {checkbox:true},
            {field:"merchant_name",title:"商户ID"},
            {field:"active_code",title:"激活码"},
            {field:"group_name",title:"所属分组"},
            {field:"expire_time",title:"失效时间"},
            {field:"platform",title:"使用平台"},
            {field:"remark",title:"备注"},
            {field:"content",title:"说明"},
            {field:"status",title:"状态"},
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
