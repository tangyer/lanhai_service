
var editFlag = "";
var removeFlag = "";
var prefix = ctx + "/customerService";

$(function() {
    var options = {
        url: prefix + "/index",
        createUrl: prefix + "/create",
        updateUrl: prefix + "/update?id={id}",
        removeUrl: prefix + "/delete",
        exportUrl: prefix + "/export",
        sortName: "id",
        modalName: "客服",
        uniqueId:"id",
        columns:[
              {checkbox:true},
            {field:"name",title:"客服名称"},
            {field:"icon",title:"图标",formatter:function (value){
                return "<img src='"+value+"' width='50'>";
            }},
            {field:"value",title:"联系方式"},
            {field:"url",title:"跳转链接"},
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
