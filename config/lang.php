<?php
// +----------------------------------------------------------------------
// | 多语言设置
// +----------------------------------------------------------------------

return [
    // 默认语言
    'default_lang'    => env('lang.default_lang', 'en'),
    // 允许的语言列表
    'allow_lang_list' => ['cn', 'en', 'de','es','pt','id','zh','tr'],
    // 多语言自动侦测变量名
    'detect_var'      => 'lang',
    // 是否使用Cookie记录
    'use_cookie'      => true,
    // 多语言cookie变量
    'cookie_var'      => 'think_lang',
    // 多语言header变量
    'header_var'      => 'lang',
    // 扩展语言包
    'extend_list'     => [
	    'cn'     => [
		    app()->getBasePath() . 'api/lang/cn/common.php',
		    app()->getBasePath() . 'common/lang/cn/common.php'
	    ],
	    'en'     => [
		    app()->getBasePath() . 'api/lang/en/common.php',
		    app()->getBasePath() . 'common/lang/en/common.php'
	    ],
	    'de'     => [
		    app()->getBasePath() . 'api/lang/de/common.php',
		    app()->getBasePath() . 'common/lang/de/common.php'
	    ],
        'es'     => [
            app()->getBasePath() . 'api/lang/es/common.php',
            app()->getBasePath() . 'common/lang/es/common.php'
        ],
        'pt'     => [
            app()->getBasePath() . 'api/lang/pt/common.php',
            app()->getBasePath() . 'common/lang/pt/common.php'
        ],
        'id'     => [
            app()->getBasePath() . 'api/lang/id/common.php',
            app()->getBasePath() . 'common/lang/id/common.php'
        ],
        'zh'     => [
            app()->getBasePath() . 'api/lang/zh/common.php',
            app()->getBasePath() . 'common/lang/zh/common.php'
        ],
        'tr'     => [
            app()->getBasePath() . 'api/lang/tr/common.php',
            app()->getBasePath() . 'common/lang/tr/common.php'
        ]

    ],
    // Accept-Language转义为对应语言包名称
    'accept_language' => [
        'zh-hans-cn' => 'cn',
    ],
    // 是否支持语言分组
    'allow_group'     => true,
];
