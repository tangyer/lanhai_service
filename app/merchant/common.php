<?php
// 这是系统自动生成的公共文件
function get_user($key = ''){
    $user = session('user');
    return $key ? ($user[$key] ?? '') : $user;
}
// 获取登录用户ID
function get_user_id(){
    $user = get_user();
    return $user ? $user['id'] : 0;
}

