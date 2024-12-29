<?php
use app\common\provider\Request;
use app\common\provider\ExceptionHandle;
// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
];
