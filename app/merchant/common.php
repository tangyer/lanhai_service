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


// 获取过去或未来N天之间的日期
function get_between_date($time = '', $format='Y-m-d',$operation='-',$days = 7){
    $time = $time != '' ? $time : time();
    //获取当前周几
    $date = [];
    for ($i=1; $i<=$days; $i++){
        $date[$i] = date($format ,strtotime( "$operation".$i-$days .' days', $time));
    }
    return $date;
}

// 获取当天24小时
function get_hours($time = '',$format='Y-m-d H:i:s',$operation='-',$hour = 24){
    $time = $time != '' ? $time : time();
    $hours = [];
    for ($i = 1; $i <= $hour; $i++) {
        $hours[$i] = date($format ,strtotime( "$operation".$i-$hour.' hours', $time));
    }
    return $hours;
}