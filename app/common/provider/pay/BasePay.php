<?php

namespace app\common\provider\pay;

use app\common\model\Config;
use think\db\exception\DataNotFoundException;
use think\exception\ValidateException;

abstract class BasePay
{
    public abstract function create($order);

    public abstract function withdraw($order);

//    public abstract function sign($data,$type);
//
//    public abstract function validateSignByKey($data);
//
//    public abstract function validateCashSignByKey($data);
//
//    public abstract function cashQuery($order);
//
//    public abstract function mchQuery();



}