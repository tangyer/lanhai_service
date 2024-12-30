<?php

return [
    'login' => [
        'success'                           => '登陸成功',
        'account_not_exist'                 => '帳戶不存在',
        'wrong_password'                    => '密碼錯誤',
        'email_already_exist'               => '電子郵件已經存在',
        'email_send_error'                  => '郵件發送失敗',
        'mobile_already_exist'              => '電話號碼已存在',
        'mobile_send_error'                 => '發送手機驗證碼失敗',
        'auth_code_error'                   => '驗證碼錯誤',
        'data_already_exists'               => '數據已經存在',
        'username_exists'                   => '此用戶名已存在',
        'mobile_exists'                     => '電話號碼已存在',
        'invite_code_error'                 => '邀請碼錯誤',
        'logout_successful'                 => '退出成功',
    ],
    'reg'                                   => [
        'password_error'                    => '密碼必須長度為 6 16 個字母加數字',
        'username_min_error'                => '用戶名不得少於5個字符'
    ],
    'change' => [
        'success'                           => '修改成功',
        'account_not_exist'                 => '帳戶不存在',
        'wrong_password'                    => '密碼錯誤'
    ],
    'cash_min'                              => '最低提款金額為{:amount}',
    'withdrawal_num_day'                    => '每日提現次數已達上線',
    'trade_password_error'                  => '交易密碼不正確',
    'level_low'                             => '水平太低',
    'balance_zero'                          => '餘額為零',
    'not_started'                           => '有进行中的订单',
    'not_exist'                             => '產品不存在',
    'contact_customer_service'              => '請聯繫客服',
    'not_match'                             => '等級和順序不匹配',
    'submit_fail'                           => '提交失敗',
    'order_none_or_invalid'                  => '沒有訂單或取消',
    'password_incorrect'                    => '密碼錯誤',
    'order_payed'                           => '訂單已付',
    'insufficient_funds'                    => '資金不足，需充值：{:amount}',
    'proceed_order'                         => '請按順序進行',
    'recharge_error'                        => '充電錯誤',
    'order_error'                           => '訂單錯誤',
    'hash_is_null'                          => '哈希為空',
    'order_completion_prompt'               => '恭喜您完成{:amount}个订单',
    'withdraw'                              => [
        'amount_require'                    => '金額要求',
    ],
    'recharge'                              => [
        'amount_require'                    => '金額要求',
        'pay_type'                          => '支付類型要求',
        'amount_min_error'                  => '最低充值金額{:amount}'
    ],
    'order'                                 => [
        'freeze_contact_customer'           => '訂單已凍結，請聯繫客服'
    ],

];