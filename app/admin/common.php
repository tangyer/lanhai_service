<?php
// 获取当前登录用户
function get_user($key = ''){
    $user = session('user');
    return $key ? ($user[$key] ?? '') : $user;
}
// 获取登录用户ID
function get_user_id(){
    $user = get_user();
    return $user ? $user['id'] : 0;
}

if (!function_exists('addLog')) {
    /**
     * 添加记录日志
     * @param $file_name  文件名
     * @param $data 要记录的数据
     * @param $extend 扩展信息
     * @return void
     */
    function addLog ($file_name, $data, $extend=[]) {
        if ($file_name && ($data || $extend)) {
            $file_path = ROOT_PATH.'admin/log/'.$file_name.'/';
            !is_dir($file_path) && mkdir($file_path, 0755, true);

            file_put_contents($file_path.date('Ymd').'.log', "\n".json_encode($data).'  '.json_encode($extend), FILE_APPEND);
        }
    }
}

if (!function_exists('getRealIP')) {
    /**
     * 获取真实ip
     * @return string
     */
    function getRealIP(): string
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        }
        if (getenv('HTTP_X_REAL_IP')) {
            $ip = getenv('HTTP_X_REAL_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
            $ips = explode(',', $ip);
            $ip = $ips[0];
        } elseif (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = '0.0.0.0';
        }

        return $ip;
    }
}




