<?php
return [
    'listen'  =>    [
        'MemberLogin'    => [
            app\api\listener\MemberLogin::class
        ],
        'MemberRegister'    => [
            app\api\listener\MemberRegister::class
        ],
    ],
];
