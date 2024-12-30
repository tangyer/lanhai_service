<?php
// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
    'layout_on'         =>  true,
    'layout_name'       =>  'layout/layout',
    'tpl_replace_string'  =>  [
        '__JS__'        => '/static/js',
        '__CSS__'       => '/static/css',
        '__IMG__'       => '/static/images/',
        '__PLUGINS__'   => '/static/js/plugins',
    ]
];
