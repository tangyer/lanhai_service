
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/merchant";

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "商户",
        uniqueId:"id",
        columns:[
            {checkbox:true},
            {field:"id",title:"商户ID"},
            {field:"merchant_name",title:"商户名称"},
            {field:"contact_type",title:"联系类型"},
            {field:"contact_code",title:"联系帐号"},
            {field:"status",title:"状态"},
            {field:"port_number",title:"端口数量"},
            {field:"content_per",title:"素材权限"},
            {field:"expire_time",title:"到期时间"},
            {field:"remark",title:"备注"},
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
