<?php
// 应用公共文件
use app\common\model\Dict;
use app\common\provider\CacheName;
use think\facade\Cache;
use think\helper\Str;

/**
 * 随机字符串
 *
 * @param integer $length 字符串长度
 * @param integer|null $type 类型 null 默认大小写字母 加 数字
 * @return string
 */
function generate_rand_str(int $length = 6, int $type = null): string
{
    return Str::random($length, $type);
}

if (!function_exists('setMemberOnline')) {
    function setMemberOnline($memberId): bool
    {
        $redis = Cache::store('redis')->handler();
        $key = "member:{$memberId}:online";
        $timestamp = time();
        // 存储用户在线状态和时间戳，设置过期时间（例如 5 分钟）
        $redis->setex($key, 300, $timestamp);
        return true;
    }
}

if (!function_exists('isMemberOnline')) {
    function isMemberOnline($memberId): bool
    {
        $redis = Cache::store('redis')->handler();
        $key = "member:{$memberId}:online";
        $timestamp = $redis->get($key);

        if ($timestamp === false) {
            return false; // 用户不在线或键不存在
        }
        $currentTime = time();
        $onlineDuration = $currentTime - $timestamp;
        return $onlineDuration <= 300;
    }
}

/**
 * 生成密码
 * @param $password
 * @param string $salt
 * @return string
 */
function generate_password($password, string $salt = ''): string
{
    return md5(md5($password . $salt));
}

/**
 * 检查密码强度 字母开头,必须包含字母和数字  6- 18位
 * @param string $password
 * @return false|int
 */
function check_password_strength(string $password = ''): bool|int
{
    return preg_match('/^[a-zA-Z](?!\D+$).{5,17}$/', $password);
}


/**
 * 生成token
 * @return string
 */
function generate_token(): string
{
    return md5(generate_rand_str(16) . (string)microtime());
}

/**
 * 生成文件地址
 * @param string $path 文件地址
 * @return string
 */
function generate_file_url(string $path = ''): string
{
    if (empty($path) || filter_var($path, FILTER_VALIDATE_URL) !== false) {
        return $path;
    };
    return request()->domain() . $path;

}


/**
 * @param int $timestamp
 * @return false|string
 */
function get_date(int $timestamp = 0): bool|string
{
    return date('Y-m-d', $timestamp ?: time());
}


/**
 * @param int $timestamp
 * @param string $format
 * @return false|string
 */
function get_time(int $timestamp = 0,string $format = 'Y-m-d H:i',): bool|string
{
    return date($format, $timestamp ?: time());
}

/**
 * 获取字典数据
 * @param string $dictType
 * @return mixed|string
 * @throws Throwable
 */
function get_dict(string $dictType = '',bool $isJson = false)
{
     $dict = Cache::remember(CacheName::DICT, function (Dict $dict) {
        return $dict->getList();
    });
    $res = $dictType ? ($dict[$dictType] ?? '') : $dict;
    return $isJson ? json_encode($res) : $res;
}

/**
 * 获取字典数据值
 * @param string $dictType
 * @return string
 */
function get_dict_label(string $dictType = '',string $value = ''): mixed
{
    $dict = get_dict($dictType);
    foreach ($dict as $item) {
        if ($item['dict_value'] == $value) {
            return $item['dict_label'];
        }
    }
    return '';
}

/**
 * 获取配置信息
 * @param string $name
 * @return mixed
 * @throws Throwable
 */
function get_config(string $name = ''): mixed
{
//    Cache::clear();
    $config = Cache::remember(CacheName::DICT, function (Dict $dict) {
        return $dict->getColumn([], 'value', 'name');
    });
    return $name ? ($config[$name] ?? '') : $config;
}
/**
 * 获取语言
 * @param bool $simple 是否一维数组
 * @return mixed
 */
function get_language_list(bool $simple = false): mixed
{
    $list = Cache::remember(CacheName::LANGUAGE, function (\app\common\model\Language $language) {
        return $language->get_All()->to_Array();
    });
    if ($simple){
        return array_column($list,'name','code');
    }
    return $list;
}

/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pk
 * @param string $pid parent标记字段
 * @param string $child
 * @param int $root
 * @return array
 */
function list_to_tree(array $list, string $pk='id', string $pid = 'parent_id', string $child = 'children', $root = 0): array
{
    $tree = [];
    // 创建基于主键的数组引用
    $refer = [];
    foreach ($list as $key => $data) {
        $refer[$data[$pk]] =& $list[$key];
    }
    foreach ($list as $key => $data) {
        // 判断是否存在parent
        $parentId =  $data[$pid];
        if ($root == $parentId) {
            $tree[] =& $list[$key];
        }else{
            if (isset($refer[$parentId])) {
                $parent =& $refer[$parentId];
                $parent[$child][] =& $list[$key];
            }
        }
    }
    return $tree;
}

