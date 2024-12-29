<?php

namespace app\common\provider;

class CacheName
{

    const PREFIX = 'lh:';

    const CONFIG = self::PREFIX.'config';

    const LANGUAGE = self::PREFIX.'language';
    const TRANSLATE_ENGINE = self::PREFIX.'translate_engine';

    // 字典数据
    const DICT = self::PREFIX.'dict';


}